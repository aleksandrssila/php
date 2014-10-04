<?php

use DB;

/**
 * Class Creator
 * Main purpose of Creator is to deal with Laravel Eloquent models when
 * is required to save multiple models which have relations to each other.
 * Single save action helps to roll back transaction if any of models fail
 * to pass validation or anything else.
 *
 * Due to lack of time :), models should be initialised with the save order,
 * as they have dependency. If user depends from account, you need to call user
 * af ter account. ($creator = Creator::(['account','user']))
 */
class Creator
{

    /**
     * @var $obj Object or array of Objects
     */
    private $obj;

    /**
     *
     * If dependency is set, class will save models which
     * do not have dependencies first and later will save
     * those which depend on others.
     *
     * example:
     *
     *      // account model will be saved before user model and same for message
     *      $creator->dependency = [
     *           'user'     => ['account_id'   => ['account' => 'id']],       // user.account_id depends from account.id
     *           'message'  => ['user_id'      => ['user' => 'id']],          // message.user_id depends from user.id
     *      ];
     *
     *
     * Array of key dependencies
     *
     * @var $dependency array
    */
    public $dependency;


    /**
     * @param $model (string array of model names or string model name)
     */
    private function __construct($model)
    {
        $this->dependency = false; // object's has no dependency
        $this->build($model);      // build model or models
    }

    /**
     * Checks if object have data dependency and solves it
     *
     * @param \Eloquent $obj
     */
    private function resolveDependency(\Eloquent &$obj)
    {
        $name = get_class($obj);
        $table = strtolower($name);
        if (isset($this->dependency[$table]))                            // if dependencies are set
        {
            foreach ($this->dependency[$table] as $column => $depend) {
                $v = current($depend);
                reset($depend);
                $k = key($depend);
                $obj->$column = $this->$k->$v;
            }
        }
    }

    /**
     * Return creator instance with models
     *
     * @param $name
     * @return Creator
     */
    public static function model($name)
    {
        return new Creator($name);
    }


    /**
     * Save's all model's to database with using database transaction
     *
     * @param bool array $data
     * @return bool
     * @throws \Exception
     */
    public function save($data = null)
    {
        $data = (is_array($data)) ? $data : false;

        try
        {
            DB::beginTransaction();                         // database transaction starts

            if (is_array($this->obj)){
                $this->saveObjects($data);
            }
            else {
                $obj = $this->obj;
                $this->saveObject($this->$obj, $data);
            }

            DB::commit();                                   // save transaction
            return true;

        }
        catch (\Exception $e)                             // Any exception is thrown
        {
            DB::rollback();                               // roll back transaction
            throw $e;                                     // rethrow exception
        }

    }

    /**
     * Builds empty model or array of empty models
     *
     * @param $model string or array
     */
    private function build($model)
    {
        if (is_array($model)) {
            $this->obj = [];
            foreach ($model as $m) {
                array_push($this->obj, $m);
                $this->$m = $this->assign($m);
            }
        } else {
            $this->obj = $model;
            $this->$model = $this->assign($model);
        }
    }

    /**
     * Saves eloquent objects
     *
     * @see saveObject()
     * @param  $data (array with column name => value pairs arrays)
     */
    private function saveObjects($data)
    {
        foreach ($this->obj as $i => $obj) {
            if ($data) {
                $this->saveObject($this->$obj, $data[$i]);
            } else {
                if ($this->dependency) {
                    $this->resolveDependency($this->$obj);
                }
                $this->$obj->save();
            }
        }
    }

    /**
     * Saves eloquent object by column name => value
     *
     * @param \Eloquent $obj
     * @param array $data (array of column name => value pairs)
     */
    private function saveObject(\Eloquent &$obj, $data)
    {
        if ($data) {
            foreach ($data as $column => $value) {
                $obj->$column = $value;
                if ($this->dependency) {
                    $this->resolveDependency($obj);  // resolve database dependency
                }
            }
        }

        $obj->save();
    }

    /**
     * Create new model by name
     *
     * @param $name (name of the model)
     * @return mixed
     */
    private function assign($name)
    {
        $model = ucfirst($name);
        return new $model;
    }

}
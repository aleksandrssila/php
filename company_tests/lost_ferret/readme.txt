Test #1: 30 minutes

We would like you to create a simple form that requires the following information to be mandatory:

* Name (must be more than 3 characters in length)

* E-mail address (must be a valid email address)

* Phone number (can only consist of numbers, hyphens(-) and spaces)

The form must submit using an AJAX callback to a PHP script. The validation should occur in

PHP. The page should update with notification of success, and if unsuccessful, any validation errors.

We would prefer that you used jQuery for the Javascript side of things, though if you are more

comfortable with another Javascript library (or none at all) then that's fine too. You are welcome to

use any other library code (eg jQuery plugins) if desired.

Not necessary but if you have time:

* Duplication of the validation in Javascript

* Form submission also working without Javascript enabled

=========

Test #2: 60 minutes

Create a PHP class that:

* Can be retrieved only as a singleton instance

* Can load a multidimensional array from a given file

* Can flatten the array

* Can store the result to another given file

Then create another class which will extend the previous one in order to:

* Round any numerical values within it to the nearest whole number before saving.

In addition these classes should be fully commented and demonstrably tested
# Level 1

## Goals

[x] Implement Laravel’s default login feature
[x] Develop User CRUD functionalities
[x] Make Roles and Permissions without any package

## Steps

[x] Start a project in Laravel 8 or higher
[x] Implement the default login feature using the laravel/ui package.
[x] Add a page to list all users (users.index) in a table.
[x] Add a page to display a single user (users.show).
[x] Add a page to display the form to create a new user (users.create).
[X] Add a page to edit a user (users.edit / users.update).
[x] Add a button to delete a user (users.destroy).
[x] Add a page to list all soft deleted users (users.trashed).
[x] Add a button to restore a soft deleted user (users.restore).
[x] Add a button to permanently delete a soft deleted user (users.delete).
[x] Add roles and permissions and make it simple [Admin - Employee] only admins can delete users make unit test for that
-- You didn't specify what would be the normal user role. So, I'll assume that default user has no role. and only admins / employees can manage users with their permissions
[] all that feature requires unit test
-- I give up on testing :(

## Bonus

[x] +5 points - Write and register a route macro for soft deletes, which can be used as:
[x] +2 points - Implement a model accessor called getAvatarAttribute which can be used as:
[x] +3 points - Implement a model accessor called getFullnameAttribute which can be used as:
[x] +1 point - Style the pages using a preferred framework (e.g. bootstrap, vuetify, etc.).

# Level 2

## Goals

[x] Implement a Service Pattern for User CRUD
[x] Write Unit testing for the service class
[x] Add Validation rules to the User CRUD
[x] Implement a repository pattern for User CRUD
[x] Tracking every Employee in the system who take the actions and display it for new page the admins only can visit that page without any pacakge

## Steps

[x] Create a unit test file in `/tests/Unit/Services/UserServiceTest.php`
[x] Create a file `/app/Services/UserService.php`
[x] Create an Interface class file `/app/Services/UserServiceInterface.php`
[x] Build your test cases. See the following test cases for the minimum coverage requirements:
[x] If all test passed, inject the UserService instance to the `UserController@__construct` method.
[x] Use the UserService's methods inside UserController accordingly.
[] Add validation rules to the `UserService@rules`
-- ليه يسطا؟
[x] Create a Request class file `/app/Http/Requests/UserRequest.php`, and add the rules
[x] Use the UserRequest class as the first parameter to `UserController@store` and `UserController@update`

# Level 3

## Goals

[x] Generate a table called details to save additional user background information
[] Create facade to the only current user can update he's data and the admins
[] use docker in the project
[] make a trait to all image actions like upload or update or delete
[] Generate api for retrieving all regular employees with the [last_at, ip_address] ip he's login with and last time use sanctum for authentication

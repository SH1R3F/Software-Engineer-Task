# Level 1

## Goals

[x] Implement Laravel’s default login feature<br>
[x] Develop User CRUD functionalities<br>
[x] Make Roles and Permissions without any package<br>

## Steps

[x] Start a project in Laravel 8 or higher<br>
[x] Implement the default login feature using the laravel/ui package.<br>
[x] Add a page to list all users (users.index) in a table.<br>
[x] Add a page to display a single user (users.show).<br>
[x] Add a page to display the form to create a new user (users.create).<br>
[X] Add a page to edit a user (users.edit / users.update).<br>
[x] Add a button to delete a user (users.destroy).<br>
[x] Add a page to list all soft deleted users (users.trashed).<br>
[x] Add a button to restore a soft deleted user (users.restore).<br>
[x] Add a button to permanently delete a soft deleted user (users.delete).<br>
[x] Add roles and permissions and make it simple [Admin - Employee] only admins can delete users make unit test for that<br>
-- You didn't specify what would be the normal user role. So, I'll assume that default user has no role. and only admins / employees can manage users with their permissions<br>
[] all that feature requires unit test<br>
-- I give up on testing :(<br>

## Bonus

[x] +5 points - Write and register a route macro for soft deletes, which can be used as:<br>
[x] +2 points - Implement a model accessor called getAvatarAttribute which can be used as:<br>
[x] +3 points - Implement a model accessor called getFullnameAttribute which can be used as:<br>
[x] +1 point - Style the pages using a preferred framework (e.g. bootstrap, vuetify, etc.).<br>

# Level 2

## Goals

[x] Implement a Service Pattern for User CRUD<br>
[x] Write Unit testing for the service class<br>
[x] Add Validation rules to the User CRUD<br>
[x] Implement a repository pattern for User CRUD<br>
[x] Tracking every Employee in the system who take the actions and display it for new page the admins only can visit that page without any pacakge<br>

## Steps

[x] Create a unit test file in `/tests/Unit/Services/UserServiceTest.php`<br>
[x] Create a file `/app/Services/UserService.php`<br>
[x] Create an Interface class file `/app/Services/UserServiceInterface.php`<br>
[x] Build your test cases. See the following test cases for the minimum coverage requirements:<br>
[x] If all test passed, inject the UserService instance to the `UserController@__construct` method.<br>
[x] Use the UserService's methods inside UserController accordingly.<br>
[] Add validation rules to the `UserService@rules`<br>
-- ليه يسطا؟<br>
[x] Create a Request class file `/app/Http/Requests/UserRequest.php`, and add the rules<br>
[x] Use the UserRequest class as the first parameter to `UserController@store` and `UserController@update`<br>

# Level 3

## Goals

[x] Generate a table called details to save additional user background information<br>
[] Create facade to the only current user can update he's data and the admins<br>
-- انت عاوز ايه حضرتك؟<br>
<s>[] use docker in the project</s><br>
[x] make a trait to all image actions like upload or update or delete<br>
[x] Generate api for retrieving all regular employees with the [last_at, ip_address] ip he's login with and last time use sanctum for authentication<br>

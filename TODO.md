# Level 1

## Goals

[x] Implement Laravel’s default login feature
[] Develop User CRUD functionalities
[] Make Roles and Permissions without any package

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

<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Services\UserService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_users()
    {
        $users = app()->make(UserService::class)->list();

        $this->assertInstanceOf(LengthAwarePaginator::class, $users);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_store_a_user_to_database()
    {
        // Arrangements
        $user = [
            'firstname' => $fname = fake()->firstName(),
            'lastname' => $lname = fake()->lastName(),
            'username' => Str::slug("$fname $lname"),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
        ];

        // Actions
        app()->make(UserService::class)->store($user);


        // Assertions
        $this->assertEquals(1, User::count());
    }

    /**
     * @test
     * @return void
     */
    public function it_can_find_and_return_an_existing_user()
    {
        // Arrangements
        $user = User::factory()->create();

        // Actions
        $found = app()->make(UserService::class)->find($user->id);

        // Assertions
        $this->assertEquals($user->id, $found->id);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_update_an_existing_user()
    {
        // Arrangements
        $user = User::factory()->create([
            'firstname' => 'karim'
        ]);

        // Actions
        app()->make(UserService::class)->update($user->id, ['firstname' => 'mahmoud']);

        // Assertions
        $this->assertEquals('mahmoud', User::find($user->id)->firstname);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_soft_delete_an_existing_user()
    {
        // Arrangements
        User::factory(10)->create();


        // Actions
        app()->make(UserService::class)->destroy(User::first()->id);

        // Assertions
        $this->assertEquals(9, User::count());
    }

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_trashed_users()
    {
        // Arrangements

        // Actions
        $trashed = app()->make(UserService::class)->listTrashed();

        // Assertions
        $this->assertInstanceOf(LengthAwarePaginator::class, $trashed);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_restore_a_soft_deleted_user()
    {
        // Arrangements
        $user = User::factory()->create();

        // Actions
        app()->make(UserService::class)->destroy($user->id);
        $beforeRestore = app()->make(UserService::class)->list();
        app()->make(UserService::class)->restore($user->id);

        // Assertions
        $this->assertEquals(0, $beforeRestore->count());
        $this->assertEquals(1, app()->make(UserService::class)->list()->count());
    }

    /**
     * @test
     * @return void
     */
    public function it_can_permanently_delete_a_soft_deleted_user()
    {
        // Arrangements
        $user = User::factory()->create();

        // Actions
        app()->make(UserService::class)->destroy($user->id);
        $beforePermanentDelete = app()->make(UserService::class)->listTrashed();
        app()->make(UserService::class)->delete($user->id);

        // Assertions
        $this->assertEquals(1, $beforePermanentDelete->count());
        $this->assertEquals(0, app()->make(UserService::class)->listTrashed()->count());
    }

    /**
     * @test
     * @return void
     */
    public function it_can_upload_photo()
    {
        // Arrangements
        $file = UploadedFile::fake()->image('avatar.jpg');

        // Actions
        $path = app()->make(UserService::class)->upload($file);

        // Assertions
        $this->assertTrue(\File::exists(public_path($path)));
    }

    /*
    * @test
    * @return void
    */
    public function test_admins_can_delete_user()
    {

        $this->seed(RolesPermissionsSeeder::class);

        // This is a bit confusing. service provider is not running ? why?
        // Yes, I'm repeating myself. the service provider is not running.
        Permission::all()->each(function ($permission) {
            Gate::define($permission->slug, function ($user) use ($permission) {
                return $user->hasPermission($permission->slug);
            });
        });

        // Arrangements
        $admin = User::factory()->create(['role_id' => '1']);
        $user = User::factory()->create();

        // Actions
        $response = $this->actingAs($admin)->delete("/users/$user->id");

        // Assertions
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    /*
    * @test
    * @return void
    */
    public function test_regular_user_cannot_delete_user()
    {
        $this->seed(RolesPermissionsSeeder::class);

        // This is a bit confusing. service provider is not running ? why?
        // Yes, I'm repeating myself. the service provider is not running.
        Permission::all()->each(function ($permission) {
            Gate::define($permission->slug, function ($user) use ($permission) {
                return $user->hasPermission($permission->slug);
            });
        });

        // Arrangements
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        // Actions
        $response = $this->actingAs($user)->delete("/users/$user2->id");

        // Assertions
        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}

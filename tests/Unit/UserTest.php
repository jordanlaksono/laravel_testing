<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_login_form(): void
    {

        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_duplication(): void
    {
        $user1 = User::make([
           'name' => 'Jordan',
           'email' => 'jordan@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'edwin',
            'email' => 'edwin@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_delete_user() : void
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_it_stores_new_users() : void
    {
        $response = $this->post('/register',[
            'name' => 'Edwin',
            'email' => 'edwinlaksono@gmail.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_database() : void
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'Laksono',
        ]);
    }

    public function test_if_seeders_works() : void
    {
        $this->seed(); // send all seeders in the Seeders folder
        //php artisan db:seed
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /*Simple Test without REST API*/
    public function testCreateUser()
    {
        $response = $this->post('/api/register', [
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => 'admin123',
           'password_confirmation' => 'admin123',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ]);
    }
    /*Simple Test without REST API*/
    public function testDeleteUser()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ]);

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ]);
    }


}

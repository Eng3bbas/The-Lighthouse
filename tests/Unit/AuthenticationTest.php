<?php

namespace Tests\Unit;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase , WithFaker;


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        Storage::disk('local');
        $response = $this->post('/register',[
            'name' => $this->faker->name('female'),
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'avatar' => UploadedFile::fake()->image('Image.jpg')
        ]);
        $response->assertRedirect('/');
    }

    public function testLogin()
    {
        User::create($data = [
            'name' => $this->faker->name('female'),
            'email' => $this->faker->email,
            'password' => 'password'
        ]);
        $response = $this->post('/login',[
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        $response->assertRedirect('/');
    }

    public function testLogout()
    {
       $user = User::create($data = [
            'name' => $this->faker->name('female'),
            'email' => $this->faker->email,
            'password' => 'password'
        ]);
       $this->actingAs($user);
       $response = $this->post('/logout');
       $response->assertRedirect('/');
    }
}

<?php


namespace Tests;


use App\Services\UserService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

trait WithAuthentication
{
    private User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->app->make(UserService::class)->register([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password'
        ]);
    }
    protected function setAsAdmin()
    {
        $this->user->update(['role' => 1]);
    }

    public function setAuthentication(bool $isAdmin = false) : void
    {
        if ($isAdmin)
            $this->setAsAdmin();
        $this->actingAs($this->user);
    }
}

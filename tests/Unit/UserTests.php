<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\TestCase;


class UserTests extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIsAdmin()
    {
        $user = new User([
            'name' => 'Agustín',
            'email' => 'eevinley@gmail.com',
            'password' => 'sis2019*',
            'type' => User::ADMIN_TYPE,
        ]);

        $this->assertTrue($user->isAdmin());
    }
}

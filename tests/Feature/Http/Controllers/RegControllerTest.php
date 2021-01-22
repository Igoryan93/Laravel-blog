<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {

        $this->withoutMiddleware();
        $data = [
            'email' => 'test1@gmail.com',
            'password' => '123123',
            'password_again' => '123123'
        ];

        $response = $this->post('/reg', $data);
        $response->assertSessionHasNoErrors()->assertSessionHas('confirm', true);

    }

    public function testVerifyUser() {

        $user = User::find(2)->first();
        $response = $this->get('/verify/' . $user->token);
        $response->assertSessionHas('success', 'Регистрация прошла успешно');
    }
}

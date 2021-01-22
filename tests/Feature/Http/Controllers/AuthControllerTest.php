<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInUser()
    {
        $this->withoutMiddleware();
        $data = [
            'email' => 'test@gmail.com',
            'password' => '123123',
            'remember' => 'on'
        ];

        $response = $this->post('/in', $data);

        $response->assertSessionHasNoErrors()
                 ->assertSessionHas('success', 'Вы успешно были авторизованы')
                 ->assertRedirect('/');
    }

    public function testLogoutUser() {

        $this->be(User::find(2));

        $response = $this->get('/logout');

        $response->assertStatus(302)
                 ->assertRedirect('/');

        $this->assertGuest();
    }

}

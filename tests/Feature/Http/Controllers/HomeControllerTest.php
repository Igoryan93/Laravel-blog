<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200)->assertSee('Список пользователей');
    }

    public function testLogin() {
        $response = $this->get('/in');
        $response->assertOk()->assertSee('Учебный проект')->assertViewIs('login');
    }

    public function testLoginIsAuth() {
        $this->be(User::find(2));
        $response = $this->get('/in');
        $response->assertStatus(302);
    }

    public function testProfile() {
        $this->be(User::find(2));
        $response = $this->call('GET', '/profile/2');
        $response->assertStatus(200)->assertSee('фывфыв');
    }

    public function testProfileNotCurrentUser() {
        $this->be(User::find(13));
        $response = $this->call('GET', '/profile/2');
        $response->assertStatus(302);
    }

    public function testEdit() {
        $this->be(User::find(2));
        $response = $this->get('/edit/2');
        $response->assertStatus(200)->assertSee('Общая информация')->assertViewIs('edit');
    }

    public function testSecurity() {
        $this->be(User::find(2));
        $response = $this->get('/security/2');
        $response->assertStatus(200)->assertSee('Безопасность')->assertViewIs('security');
    }

    public function testStatus() {
        $this->be(User::find(14));
        $response = $this->get('/status/2');
        $response->assertStatus(200)->assertSee('Установить статус')->assertViewIs('status');
    }

    public function testMedia() {
        $this->be(User::find(14));
        $response = $this->get('/media/2');
        $response->assertStatus(200)->assertSee('Загрузить аватар')->assertViewIs('media');
    }
}

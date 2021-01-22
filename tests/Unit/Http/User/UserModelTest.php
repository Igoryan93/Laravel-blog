<?php

namespace Tests\Unit\Http\User;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testUserCreate()
    {
        $data = [
            'email' => uniqid(str_random(3)) . '@gmail.com',
            'password' => '123123123',
        ];

        $response = User::create($data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ])->assertIsBool($response);

    }
    public function testUserUpdate() {
        $data = [
            'email' => uniqid(str_random(3)) . '@gmail.com',
            'password' => bcrypt('123123'),
            'verify' => 1
        ];

        $id = 2;

        $response = User::updateById($id, $data);

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ])->assertIsBool($response);
    }

    public function testUserSelect() {

        $response = User::selectAll();

        $this->assertIsArray($response);
    }

    public function testUserSelectById() {
        $response = User::selectById(2);

        $this->assertIsArray($response);
        $this->assertCount(1, $response);
    }

    public function testUserDeleteById() {
        $id = rand(3, 12);
        $response = User::deleteById($id);

        $this->assertIsBool($response);
    }

}

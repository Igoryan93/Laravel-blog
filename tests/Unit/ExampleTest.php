<?php

namespace Tests\Unit;

use App\Http\Controllers\HomeController;
use App\Info;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */

//    use RefreshDatabase;

    public function register()
    {
//        $data = [
//            'email' => 'test_email@gmail.com',
//            'password' => '123123',
//            'verify' => 0,
//            'token' => uniqid(str_random()),
//            'token_date' => date('Y-m-d'),
//            'is_admin' => 0
//        ];
//
//        User::register($data);
//
        $this->assertDatabaseHas('users', [
            'email' => 'test_email@gmail.com',
            'password' => '123123',
            'verify' => 0,
            'is_admin' => 0

        ]);

        $data = [
            'name' => 'testing name',
            'job' => 'testing job',
            'phone' => 'testing phone',
            'address' => 'testing address',
        ];

//        Info::createInfoTest($data, 1);
//
        $this->assertDatabaseHas('info_users', [
            'user_id' => 1,
            'name' => 'testing name'
        ]);


//        factory(User::class, 5)->create();


    }
}

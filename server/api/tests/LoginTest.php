<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase {

    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();
    }

    public function testLoginNotFound()
    {
        $this->json('GET', 'api/login', [], ['Authorization' => "Basic " . $this->getToken('test', 'test')])
             ->assertResponseStatus(400);
    }

    public function testLoginFound()
    {
        $password = 'test';
        $h = Hash::make($password);
        $user = factory(User::class)->create([
            'password' => $h
        ]);
        $test = $this->json('GET', 'api/login', [], ['Authorization' => "Basic " . $this->getToken($user->email, $password)]);
        $test->dump();
        $test->assertResponseStatus(200);
    }

    private function getToken($u, $p){
        return base64_encode("$u:$p");
    }
}

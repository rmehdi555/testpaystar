<?php

namespace Tests\Feature\Model;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class ModelUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_insert()
    {
        $data = User::factory()->make()->toArray();
        $data['password']='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        User::create($data);
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
        ]);
    }
}

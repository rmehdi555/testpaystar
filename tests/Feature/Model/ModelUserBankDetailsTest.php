<?php

namespace Tests\Feature\Model;

use App\Models\User;
use App\Models\UserBankDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelUserBankDetailsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert()
    {
        $user = User::factory()
            ->has(UserBankDetails::factory()->count(1))
            ->create();

        $this->assertDatabaseHas('user_bank_details', [
            'firstname' => $user->userBankDetails[0]->firstname,
        ]);
    }
}

<?php

namespace Tests\Feature\Model;

use App\Models\Transactions;
use App\Models\User;
use App\Models\UserBankDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelTransactionTest extends TestCase
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
        $transaction=Transactions::factory(1,[
            'user_id'=> $user->id,
            'user_bank_details_id'=> $user->userBankDetails[0]->id,
        ])->create();
        $this->assertDatabaseHas('transactions', [
            'destinationNumber' => $transaction[0]->destinationNumber,
        ]);
    }
}

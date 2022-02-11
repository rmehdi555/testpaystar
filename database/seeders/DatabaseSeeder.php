<?php

namespace Database\Seeders;

use App\Models\Transactions;
use App\Models\User;
use App\Models\UserBankDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //User::factory(10)->create();

        User::factory()
            ->count(10)
            ->hasUserBankDetails(1)
            ->create();

        $users=User::all();
        foreach ($users as $user)
        {
            Transactions::factory(5,[
                'user_id'=> $user->id,
                'user_bank_details_id'=> $user->userBankDetails()->first()->id,
            ])->create();
        }



    }
}

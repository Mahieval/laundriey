<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "adminIval";
        $administrator->name = "Laundry Admin";
        $administrator->email = "mahievalfaris@gmail.com";
        $administrator->password = \Hash::make("12345678");
        $administrator->phone = "081285075469";
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Kota Bogor";
        
        $administrator->save();


        $this->command->info("Admin berhasil diinsert");
        }
    }


<?php

use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Outlet;
        $administrator->nama = "Laundry Saha";
        $administrator->alamat = "Jl. sama dia no.96";
        $administrator->tlp = "0897654321";
        $administrator->save();

        $administrator = new \App\Outlet;
        $administrator->nama = "Laundry Saya";
        $administrator->alamat = "Jl. Tak terbatas no.69";
        $administrator->tlp = "0897654321";

        $administrator->save();
        $this->command->info("Outlet berhasil diinsert");
    }
}

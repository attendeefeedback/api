<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'contact_no' => '0000000000',
                'password' => 'xxxxxxxxxx',
                'unique_id' => Str::orderedUuid()
            ]]);
    }
}
<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admins = [
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'status' => 1,
                'remember_token' => Str::random(10),
                'password' => bcrypt('john123'),
            ],
            [
                'name' => 'Desmond Ava',
                'email' => 'ava@gmail.com',
                'status' => 1,
                'password' => bcrypt('ava123'),
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($admins as $admin) {
            \App\Models\Admin\Admin::updateOrCreate($admin);
        }

    }

}

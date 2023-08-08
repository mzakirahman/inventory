<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_user' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'nama_user' => "Erik Setiawan",
            'username' => "admin",
            'role' => "1",
            'password' => bcrypt(md5('admin')),
            'foto' => "files/user/default.png"
        ]);
    }
}

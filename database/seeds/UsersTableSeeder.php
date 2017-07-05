<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data['name'] = 'admin';
        $data['username'] = 'admin';
        $data['password'] = md5('admin');
        $data['password'] = md5('admin');
        $data['last_login_ip'] = '127.0.0.1';
        $data['register'] = date('Y-m-d H:i:s');
        $data['last_login'] = date('Y-m-d H:i:s');
        \App\Models\User::create($data);
    }
}

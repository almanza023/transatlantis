<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $admins = [
            'first_name' => 'Edwin Jose',
            'last_name' => 'Florez Peralta',
            'address' => 'Calle 42 I # 17-71',
            'email' => 'edwin.florez@cun.edu.co',
            'contact_number' => '3003784390',
        ];

        $users = [
            'type_user' => 1,
            'email' => 'admin@admin.com.co',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'user_status' => 1,
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];

        $admin = Admin::create($admins);
        $admin->user()->create($users);
    }
}

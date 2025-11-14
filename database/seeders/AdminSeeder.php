<?php
namespace Database\Seeders;

use App\Models\Traders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        if (!Traders::where('email','admin@ecotrade.local')->exists()) {
            Traders::create([
                'firstName' => 'Admin',
                'middleName' => 'System',
                'lastName' => 'User',
                'address' => '123 Admin St',
                'city' => 'Admin City',
                'province' => 'Admin Province',
                'country' => 'Admin Country',
                'email' => 'admin@ecotrade.local', 
                'contactNumber' => '09123456789',
                'password' => Hash::make('AdminPass123'),
                'zipCode' => '1000',
                'role' => 'admin',
                'accountStatus' => 'active',
            ]);
        }
    }
}

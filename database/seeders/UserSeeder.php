<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $investor = User::create([
            'name'      => 'Glenaldin Halim',
            'email'     => 'glenaldin@modalink.test',
            'gender'    => 'M',
            'phone'     => '6281200112233',
            'password'  => bcrypt('password')
        ]);
        $investor->assignRole('investor');

        $merchant = User::create([
            'name'      => 'Hisyam Agung',
            'email'     => 'agung@modalink.test',
            'gender'    => 'M',
            'phone'     => '6281200112233',
            'password'  => bcrypt('password')
        ]);
        $merchant->assignRole('merchant');

        $bod = User::create([
            'name'      => 'Chief of Technology',
            'email'     => 'cto@modalink.test',
            'gender'    => 'M',
            'phone'     => '6281200112233',
            'password'  => bcrypt('password')
        ]);
        $bod->assignRole('webmaster');
        
        $webmaster = User::create([
            'name'      => 'WebMaster',
            'email'     => 'webmaster@modalink.test',
            'gender'    => 'M',
            'phone'     => '6281200112233',
            'password'  => bcrypt('password')
        ]);
        $webmaster->assignRole('webmaster');

        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@modalink.test',
            'gender'    => 'M',
            'phone'     => '6281200112233',
            'password'  => bcrypt('password')
        ]);
        $admin->assignRole('admin');
    }
}

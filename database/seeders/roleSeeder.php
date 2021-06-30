<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = DB::table('roles')->insert([
            'role_name'     => 'Project Manager',
            'description'   => 'responsible for planning and overseeing projects to 
                                ensure they are completed in a timely fashion and within budget.'
        ]);

        $role2 = DB::table('roles')->insert([
            'role_name'     => 'Front-end Developer',
            'description'   => 'responsible for implementing visual and interactive elements that 
                                users engage with through their web browser when using a web application.'
        ]);

        $role3 = DB::table('roles')->insert([
            'role_name'     => 'Back-end Developer',
            'description'   => 'designs, codes or configures, tests, debugs, deploys, 
                                documents and maintains web service applications using a variety of software 
                                development toolkits, testing/verification applications and other tools, 
                                while adhering to specific development best practices and quality standards.'
        ]);

        $role4 = DB::table('roles')->insert([
            'role_name'     => 'Full-stack Developer',
            'description'   => 'ncludes designing user interactions on websites, 
                                developing servers and databases for website functionality and 
                                coding for mobile platforms.'
        ]);
    }
}

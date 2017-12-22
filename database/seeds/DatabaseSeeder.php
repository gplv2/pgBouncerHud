<?php

use Illuminate\Database\Seeder;

//use App\User;
use App\Category;
use App\Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        3 "," Single  | 2017-12-19 15:29:51 | 2017-12-19 15:29:55
        4 "," Master  | 2017-12-19 15:29:51 | 2017-12-19 15:29:55
        5 "," Slave   | 2017-12-19 15:29:51 | 2017-12-19 15:29:55
        0 "," Default | 2017-12-19 15:29:51 | 2017-12-19 15:29:55
        */
        $this->command->info('Seeding Categories');
        DB::table('categories')->insert(
            [ 'name' => 'Default' ],
            [ 'name' => 'Single' ],
            [ 'name' => 'Master' ],
            [ 'name' => 'Slave' ]
        );
        $this->command->info('Seeding Bouncers');
        $this->call('BouncerTableSeeder');
    }
}

class BouncerTableSeeder extends Seeder {
    /**
     * Run the bouncers seeds.
     *
     * @return void
     */
    public function run() {
        $bball = array(
            array("label"=>"bouncer-fidus", "category_id"=>0,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.24:5432/pgbouncer","priority"=>0,"description"=>"Sudif bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-vip", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.34.134:5432/pgbouncer","priority"=>0 ,"description"=>"PPC test bouncer", "enabled"=>true),
            array("label"=>"bouncer-arts", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.7:5432/pgbouncer","priority"=>0 ,"description"=>"Arts test bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-arts", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.231:5432/pgbouncer","priority"=>0 ,"description"=>"PPC arts bouncer", "enabled"=>true),
            array("label"=>"bouncer-smu", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.8:5432/pgbouncer","priority"=>0 ,"description"=>"First test bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-smu", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.232:5432/pgbouncer","priority"=>0 ,"description"=>"PPC smu staging bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.22.232:5432/pgbouncer","priority"=>0 ,"description"=>"PPC smu staging bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.13.207:5432/pgbouncer","priority"=>0 ,"description"=>"PPC arts staging bouncer", "enabled"=>true),
            array("label"=>"bouncer-arts-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.56:5432/pgbouncer","priority"=>0 ,"description"=>"Arts test bouncer", "enabled"=>true),
            array("label"=>"bouncer-smu-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.57:5432/pgbouncer","priority"=>0 ,"description"=>"SMU test bouncer", "enabled"=>true),
            array("label"=>"bouncer-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.58:5432/pgbouncer","priority"=>99 ,"description"=>"SMU sta bouncer", "enabled"=>true),
            array("label"=>"bouncer-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.55:5432/pgbouncer","priority"=>99 ,"description"=>"ARTS sta bouncer", "enabled"=>true),
            array("label"=>"bouncer-home", "category_id"=>0 ,"dsn"=>"postgresql://bouncermon:bouncerpass@127.0.0.1:5432/pgbouncer","priority"=>0 ,"description"=>"Home tester", "enabled"=>true) 
        );

        DB::table('bouncers')->delete();
        DB::table('bouncers')->insert($bball);
        
    }
}

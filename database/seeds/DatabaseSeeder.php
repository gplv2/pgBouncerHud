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
        DB::table('categories')->delete();
        $this->command->info('Seeding Categories');
        DB::table('categories')->insert(array(
            array( 'id'=>0, 'name' => 'Default' ),
            array( 'id'=>1, 'name' => 'Single' ),
            array( 'id'=>2, 'name' => 'Master' ),
            array( 'id'=>3, 'name' => 'Slave' ),
            array( 'id'=>4, 'name' => 'VIP' ))
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
/*
 id |  name   | created_at | updated_at 
----+---------+------------+------------
  0 | Default |            | 
  1 | Single  |            | 
  2 | Master  |            | 
  3 | Slave   |            | 
  4 | VIP     |            | 

 id          | integer                        | not null default nextval('bouncers_id_seq'::regclass)
 label       | character varying(255)         | not null
 category_id | integer                        | not null
 dsn         | character varying(255)         | not null
 priority    | integer                        | not null default 0
 description | character varying(255)         | not null
 created_at  | timestamp(0) without time zone | 
 updated_at  | timestamp(0) without time zone | 
 enabled     | boolean                        | not null default false
 tag         | character varying(255)         | 
 cluster_id  | integer                        | 
 role        | character varying(255)         | 


*/
        $bball = array(
            array("label"=>"bouncer-fidus-vip", "category_id"=>4,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.24:5432/pgbouncer","priority"=>0,"tag"=> "prd" ,"description"=>"Sudif bouncer", "enabled"=>true),
            array("label"=>"bouncer-internal-vip", "category_id"=>4 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.34.134:5432/pgbouncer","priority"=>0 ,"tag"=> "internal","description"=>"PPC test bouncer", "enabled"=>true),
            array("label"=>"bouncer-arts-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.7:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"Arts bouncer", "enabled"=>true),
            array("label"=>"bouncer-ppc-arts", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.231:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"PPC ARTS prd", "enabled"=>true),
            array("label"=>"bouncer-smu-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.8:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"SMU prd", "enabled"=>true),
            array("label"=>"bouncer-ppc-smu-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.232:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"PPC SMU prd", "enabled"=>true),
            array("label"=>"bouncer-ppc-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.22.232:5432/pgbouncer","priority"=>0 ,"tag"=> "sta","description"=>"PPC smu staging", "enabled"=>true),
            array("label"=>"bouncer-ppc-arts-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.13.207:5432/pgbouncer","priority"=>0 , "tag"=> "tst","description"=>"PPC arts tst", "enabled"=>true),
            array("label"=>"bouncer-arts-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.56:5432/pgbouncer","priority"=>0 ,"tag"=> "tst","description"=>"Arts test", "enabled"=>true),
            array("label"=>"bouncer-smu-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.57:5432/pgbouncer","priority"=>0 ,"tag"=> "tst","description"=>"SMU test", "enabled"=>true),
            array("label"=>"bouncer-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.58:5432/pgbouncer","priority"=>99 ,"tag"=> "sta","description"=>"SMU sta", "enabled"=>false),
            array("label"=>"bouncer-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.55:5432/pgbouncer","priority"=>99 ,"tag"=> "sta","description"=>"ARTS sta", "enabled"=>false),
            array("label"=>"bouncer-home", "category_id"=>0 ,"dsn"=>"postgresql://bouncermon:bouncerpass@127.0.0.1:5432/pgbouncer","priority"=>0 ,"tag"=> "internal","description"=>"Home tester", "enabled"=>false),
            array("label"=>"bouncer-arts-dev", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.157:5432/pgbouncer","priority"=>0 ,"tag"=> "dev","description"=>"Arts test", "enabled"=>false),
            array("label"=>"bouncer-smu-dev", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.158:5432/pgbouncer","priority"=>0 ,"tag"=> "dev","description"=>"Siamu test", "enabled"=>false),
            array("label"=>"bouncer-ppc-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.22.231:5432/pgbouncer","priority"=>0 ,"tag"=> "sta","description"=>"Arts PPC staging", "enabled"=>true)
        );

        DB::table('bouncers')->delete();
        DB::table('bouncers')->insert($bball);
        
    }
}

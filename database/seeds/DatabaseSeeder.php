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

        $this->command->info('Seeding Clusters');
        $this->call('ClusterTableSeeder');

        $this->command->info('Seeding Members');
        $this->call('MemberTableSeeder');
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
            array("bouncer_id"=> 1,"label"=>"bouncer-fidus-vip", "category_id"=>4,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.24:5432/pgbouncer","priority"=>0,"tag"=> "prd" ,"description"=>"Sudif bouncer", "enabled"=>true),
            array("bouncer_id"=> 2,"label"=>"bouncer-internal-vip", "category_id"=>4 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.34.134:5432/pgbouncer","priority"=>0 ,"tag"=> "internal","description"=>"PPC test bouncer", "enabled"=>true),
            array("bouncer_id"=> 3,"label"=>"bouncer-arts-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.7:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"Arts bouncer", "enabled"=>true),
            array("bouncer_id"=> 4,"label"=>"bouncer-ppc-arts", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.231:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"PPC ARTS prd", "enabled"=>true),
            array("bouncer_id"=> 5,"label"=>"bouncer-smu-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.16.8:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"SMU prd", "enabled"=>true),
            array("bouncer_id"=> 6,"label"=>"bouncer-ppc-smu-prd", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.14.232:5432/pgbouncer","priority"=>0 ,"tag"=> "prd","description"=>"PPC SMU prd", "enabled"=>true),
            array("bouncer_id"=> 7,"label"=>"bouncer-ppc-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.22.232:5432/pgbouncer","priority"=>0 ,"tag"=> "sta","description"=>"PPC smu staging", "enabled"=>true),
            array("bouncer_id"=> 8,"label"=>"bouncer-ppc-arts-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.13.207:5432/pgbouncer","priority"=>0 , "tag"=> "tst","description"=>"PPC arts tst", "enabled"=>true),
            array("bouncer_id"=> 9,"label"=>"bouncer-arts-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.56:5432/pgbouncer","priority"=>0 ,"tag"=> "tst","description"=>"Arts test", "enabled"=>true),
            array("bouncer_id"=> 10,"label"=>"bouncer-smu-tst", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.57:5432/pgbouncer","priority"=>0 ,"tag"=> "tst","description"=>"SMU test", "enabled"=>true),
            array("bouncer_id"=> 11,"label"=>"bouncer-smu-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.58:5432/pgbouncer","priority"=>99 ,"tag"=> "sta","description"=>"SMU sta", "enabled"=>false),
            array("bouncer_id"=> 12,"label"=>"bouncer-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.23.55:5432/pgbouncer","priority"=>99 ,"tag"=> "sta","description"=>"ARTS sta", "enabled"=>false),
            array("bouncer_id"=> 13,"label"=>"bouncer-home", "category_id"=>0 ,"dsn"=>"postgresql://bouncermon:bouncerpass@127.0.0.1:5432/pgbouncer","priority"=>0 ,"tag"=> "internal","description"=>"Home tester", "enabled"=>false),
            array("bouncer_id"=> 14,"label"=>"bouncer-arts-dev", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.157:5432/pgbouncer","priority"=>0 ,"tag"=> "dev","description"=>"Arts test", "enabled"=>false),
            array("bouncer_id"=> 15,"label"=>"bouncer-smu-dev", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.26.158:5432/pgbouncer","priority"=>0 ,"tag"=> "dev","description"=>"Siamu test", "enabled"=>false),
            array("bouncer_id"=> 16,"label"=>"bouncer-ppc-arts-sta", "category_id"=>0 ,"dsn"=>"postgresql://pghud:OVBx0iyJIM6qE@192.168.22.231:5432/pgbouncer","priority"=>0 ,"tag"=> "sta","description"=>"Arts PPC staging", "enabled"=>true)
        );

        DB::table('bouncers')->delete();
        DB::table('bouncers')->insert($bball);

    }
}

class ClusterTableSeeder extends Seeder {
    /**
     * Run the bouncers seeds.
     *
     * @return void
     */
    public function run() {
        $clusters = array(
            array("cluster_id"=> 10,"label"=>"First test cluster", "description"=>"Primary bouncer cluster", "enabled"=>true),
            array("cluster_id"=> 10,"label"=>"Second test cluster", "description"=>"Secondary bouncer cluster", "enabled"=>false),
        );

        DB::table('clusters')->delete();
        DB::table('clusters')->insert($clusters);
    }
}

class MemberTableSeeder extends Seeder {
    /**
     * Run the bouncers seeds.
     *
     * @return void
     */
    public function run() {
        $cluster_members = array(
            array("cluster_id"=> 10,"bouncer_id" => 9),
            array("cluster_id"=> 10,"bouncer_id" => 10)
        );

        DB::table('members')->delete();
        DB::table('members')->insert($cluster_memberss);
    }
}

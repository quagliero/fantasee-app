<?php

class SeasonsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('seasons')->truncate();

        Season::create(['year' => 2012]);
        Season::create(['year' => 2013]);
        Season::create(['year' => 2014]);
        Season::create(['year' => 2015]);
    }

}

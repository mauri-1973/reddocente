<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoriesblog')->insert([
            'title' => 'Web Development',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

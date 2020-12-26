<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
		//$this->call(AdminsTableSeeder::class);
		//$this->call(SectionTableSeeder::class);
		//$this->call(CategoryTableSeeder::class);
		//$this->call(ProductTableSeeder::class);
		//$this->call(ProductsAttributeTableSeeder::class);
		//$this->call(ProductsImageTableSeeder::class);
		//$this->call(BrandsTableSeeder::class);
		$this->call(BannersTableSeeder::class);
    }
}

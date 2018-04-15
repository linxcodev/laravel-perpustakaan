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
      // unutk memanggil Seeder yang banyak ke database tambahkan syntak dibawah ini
        $this->call(UsersSeeder::class);
        $this->call(BooksSeeder::class);
    }
}

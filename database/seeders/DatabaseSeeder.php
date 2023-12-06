<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);

        // $rand = rand(1, 10);
        // $users = User::all();
        // Article::all()->each(function ($artilce) use ($users, $rand) {
        //     $artilce->users()->attach(
        //         $users->random($rand)->pluck('id')->toArray()
        //     );
        // });
    }
}

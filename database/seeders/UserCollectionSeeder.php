<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class UserCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
        ->has(Post::factory()->count(3))
        ->state(['email' => 'cesar@gmail.com'])
        ->create();
    }
}

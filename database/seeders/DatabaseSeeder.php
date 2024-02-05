<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Eliminar carpetas en public
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('profile');
        
        //Crear carpetas en public
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');
        Storage::makeDirectory('profile');

        //Llamar al seeder
        $this->call(UserSeeder::class);

        //Llamar Factorty
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
        Profile::factory(8)->create();
    }
}

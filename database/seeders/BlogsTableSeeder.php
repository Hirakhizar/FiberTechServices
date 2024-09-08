<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        Blog::factory()->count(20)->create();
    }
}

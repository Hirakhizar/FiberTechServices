<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogAPiController extends Controller
{
    public function index()
    {
        return response()->json(Blog::all(), 200);
    }

    
    public function show($id)
    {
        $blog = Blog::find($id);
        
        if ($blog) {
            return response()->json($blog, 200);
        } else {
            return response()->json(['error' => 'Blog not found'], 404);
        }
    }
   public function latest()
{

    $blogs = Blog::orderBy('created_at', 'desc')->get();

    if ($blogs->isEmpty()) {
        return response()->json(['error' => 'No blogs found'], 404);
    }

    return response()->json($blogs, 200);
}


}

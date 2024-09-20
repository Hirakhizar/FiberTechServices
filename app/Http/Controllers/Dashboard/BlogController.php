<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs=Blog::get();
        return view('blogs',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function blogForm()
    {
        return view('blogForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addBlog(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'details' => 'required|string',
            'meta_title' => 'required|string', // Validate meta title
            'meta_description' => 'required|string',   
        ]);
    
        // Store the image and get the path
        $imagePath = $request->file('image')->store('blogImages', 'public');
     // Prepare SEO data
    
        // Create a new blog entry
        Blog::create([
            'image' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'details' => $request->details,
            'seo' =>  json_encode([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]),
        
        ]);
    
        return redirect()->route('blog')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog=Blog::find($id);
        return view('blogDetails',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm(string $id)
    {

        $blog=Blog::findOrFail($id);
        return view('editForm' ,compact('blog'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBlog(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'details' => 'required|string',
            'meta_title' => 'required|string|max:255', // Validate meta title
            'meta_description' => 'required|string',   // Validate meta description
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Find the blog by ID
        $blog = Blog::findOrFail($id);
    
        // Handle the file upload, if there is a new image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blog->image && \Storage::exists('public/' . $blog->image)) {
                \Storage::delete('public/' . $blog->image);
            }
    
            // Store the new image and get the path
            $imagePath = $request->file('image')->store('blogImages', 'public');
    
            // Update the blog's image path
            $blog->image = $imagePath;
        }
    
        // Update the blog with the validated data
        $blog->title = $validatedData['title'];
        $blog->description = $validatedData['description'];
        $blog->details = $validatedData['details'];
    
        // Update the SEO information
        $blog->seo = json_encode([
            'meta_title' => $validatedData['meta_title'],
            'meta_description' => $validatedData['meta_description'],
        ]);
    
        // Save the changes to the database
        $blog->save();
    
        // Redirect to the blog list or show page with a success message
        return redirect()->route('blog')->with('success', 'Blog updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

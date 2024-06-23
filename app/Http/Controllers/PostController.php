<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
   public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'caption' => 'required|string',
        'tags' => 'nullable|string',
        'location' => 'nullable|string',
        'file' => 'required|file|mimes:svg,jpeg,jpg',
    ]);

    if ($request->hasFile('file')) {
        
        $file = $request->file('file');
        $filePath = $file->store('uploads', 'public');
    } else {
        return response()->json(['message' => 'File not found in request'], 400);
    }

    $user = auth()->user()->id;

    
    $post = new Post();
    $post->caption = $validatedData['caption'];
    $post->tags = $validatedData['tags'] ?? null;  
    $post->location = $validatedData['location'] ?? null; 
    $post->image_url = $filePath;
    $post->image_id = uniqid();
    $post->creator = $user;
    $post->save();

    return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
}


    public function getAllPosts(){
      
       $posts = Post::with('user:id,name')->orderBy('created_at', 'desc')->take(20)->get();
       return response()->json($posts);
    }
}

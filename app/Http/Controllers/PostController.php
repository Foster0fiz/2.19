<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest; 
use App\Http\Requests\UpdatePostRequest; 
use App\Http\Requests\UpdateProfileRequest; class PostController extends Controller
{
       public function index()
    {
        $posts = Post::with('user')->get(); 
        return view('home', compact('posts'));
    }

  
    public function create()
    {
        return view('posts.create');
    }

   
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth()->id();
        $post->save();
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image_url = $path;
            $post->save();
        }
    
        return redirect()->route('home')->with('status', 'Пост успешно создан!');
    }
    

    
    public function edit(Post $post)
    {
        
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

  
    public function update(UpdatePostRequest $request, Post $post)
{
    $post->title = $request->title;
    $post->description = $request->description;

    if ($request->hasFile('image')) {
       
        if ($post->image_url && file_exists(public_path('storage/' . $post->image_url))) {
            unlink(public_path('storage/' . $post->image_url));
        }

       
        $path = $request->file('image')->store('posts', 'public');
        $post->image_url = $path;
    }

    $post->save();

    return redirect()->route('home')->with('status', 'Пост обновлен!');
}

  
    public function destroy(Post $post)
    {
       
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

       
        if ($post->image_url && file_exists(public_path('storage/' . $post->image_url))) {
            unlink(public_path('storage/' . $post->image_url));
        }

        $post->delete();

        return redirect()->route('home')->with('status', 'Пост удалён');
    }

    
    public function editProfile()
    {
        $user = Auth::user(); 
        return view('profile.edit', compact('user'));  
    }

    
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
    
      
        if ($request->hasFile('image')) {
           
            if ($user->image_url && file_exists(public_path('storage/' . $user->image_url))) {
                unlink(public_path('storage/' . $user->image_url));
            }
    
           
            $path = $request->file('image')->store('avatars', 'public');
            $user->image_url = $path;
        }
    
        $user->save();
    
        return redirect()->route('profile.edit')->with('status', 'Профиль обновлен!');
    }
    
}

<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        $posts = Post::select('posts.*', 'users.name')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach($posts as $post){
            
            $post['day_create'] = $post['created_at']->format('H:m d-m-Y');
            $post['day_create'] = $post['updated_at']->format('H:m d-m-Y');
        }

        return $posts;
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return $post;
    }

    public function update(array $array)
    {   
        $post = Post::findOrFail($array['id']);
        $file_path = public_path('uploads/images/posts' . '/' . $post['coverImage']);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        $fileName = time() . rand() . '.' . $array['imageUpload']->getClientOriginalExtension();
        $post->update([
            'title' => $array['titlePost'],
                'content' =>  $array['content'],
                'user_id' => $array['user_id'],
                'coverImage' => $fileName,
        ]);
        $array['imageUpload']->move(public_path("uploads/images/posts"), $fileName);
        return $post;
    }
    public function destroy($id)
    {
       return Post::where('id', $id)->delete();
        
    }

    public function create(array $array)
    {  
        $fileName = time() . rand() . '.' . $array['imageUpload']->getClientOriginalExtension();
        $post = Post::create([
                'title' => $array['titlePost'],
                'content' =>  $array['content'],
                'user_id' => $array['user_id'],
                'coverImage' => $fileName,
            ]);
        $array['imageUpload']->move(public_path("uploads/images/posts"), $fileName);
        return $post;
    }
    public function getPostNews()
    {

        $postNews = Post::select('id', 'title', 'view', 'coverImage', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        foreach ($postNews as $postNew) {

            $postNew['day_create'] = $postNew['created_at']->format('H:m d/m/Y');
        }

        return $postNews;
    }
    public function view($id)
    {
        $view = Post::where('id', $id)->increment('view');

        return $view;
    }

    public function postRandom()
    {
        $views = Post::inRandomOrder()->limit(8)->get();

        return $views;
    }
}

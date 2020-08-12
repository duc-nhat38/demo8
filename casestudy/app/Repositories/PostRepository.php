<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        $posts = Post::select('posts.*', 'users.name')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->get();
        foreach ($posts as $post) {
            $post['day_create'] = $post['created_at']->format('d/m/Y');
            $post['day_update'] = $post['updated_at']->format('d/m/Y');
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
        $post->title = $array['title'];
        $post->content = $array['content'];
        $post->user_id = $array['user_id'];
        $post->coverImage = $array['coverImage'];
        $post->save();

        return $post;
    }
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
    }

    public function create(array $array)
    {
        $post = new Post();
        $post->title = $array['title'];
        $post->content = $array['content'];
        $post->user_id = $array['user_id'];
        $post->coverImage = $array['coverImage'];
        $post->save();

        return $post;
    }
}

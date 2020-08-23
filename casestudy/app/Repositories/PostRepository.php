<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        $posts = Post::select('posts.*', 'users.name')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        foreach($posts as $post){
            $post['day_create'] = $post['created_at']->format('H:m d-m-Y');
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

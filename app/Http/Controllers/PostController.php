<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepositoryInterface)
    {
        $this->postRepository = $postRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->all();

        return response()->json($posts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $request->all();
        $post = $this->postRepository->create($attribute);

        return response()->json($post, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post = $this->postRepository->show($request->id);

        return response()->json($post, 200);
    }
    public function getPostNews(){

        $postNew = $this->postRepository->getPostNews();

        return response()->json($postNew, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attribute = $request->all();
        $post = $this->postRepository->update($attribute);

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $post = $this->postRepository->destroy($id);

        return response()->json($post);
    }
    public function postDetail($id){
             
        $postKey = 'post_'.$id;
        if(!Session::has($postKey)){
            $view = $this->postRepository->view($id);
            Session::put($postKey, 1);
        }
        $post = $this->postRepository->show($id);
        $postInvolve = $this->postRepository->postRandom();  
        return view('user.PostDetail', compact(['post', 'postInvolve']));
    }

    public function all(){
        $posts = $this->postRepository->all();

        return view('user.PostAll', compact('posts'));
    }
}

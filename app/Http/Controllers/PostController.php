<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function createPost(Request $request){
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = 1;
        if ($post->save()){
            return response()->json([
                'success' => true,
                'data' => $post
            ]);
        }
        else {
            return response()->json([
                'success'=>false,
                'message' =>'Post not added!'
            ]);
        }
    }

    public function getAllPost(){
        $posts = Post::get();
        return response()->json(['success'=>true, 'data'=>$posts]);
    }

    public function getPostById($id){
        $post = Post::find($id);
        if ($post){
            return response()->json(['success'=>true, 'data'=>$post]);
        }
        else {
            return response()->json(['success'=>true, ' message'=>'Post not found!']);
        }
    }

    public function updatePost($id, Request $request){
        $post = Post::find($id);

        if ($post){
            // I will fill all the item in post
            // With all the items in request
            $updated = $post->fill($request->all())->save();
            if ($updated){
                return response()->json(['success'=>true, 'data'=>$post]);
            }
            else {
                return response()->json(['success'=>true, ' message'=>'Something is wrong upon saving']);
            }

        }
        else {
            return response()->json(['success'=>true, ' message'=>'Post not found!']);
        }

    }
}

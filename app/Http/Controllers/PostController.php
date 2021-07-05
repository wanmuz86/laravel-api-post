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
            $post->tags()->attach($request->tags);
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

    public function getAllPost(Request $request){
        $catIds = $request->catIds;
        if ($catIds === null){
        $posts = Post::get();

    } 
    else {
// Just retrieve the given tags..

        $posts = Post::whereHas('tags', function ($q) use ($catIds){
            $q->whereIn('tag_id', str_split($catIds));
        })->get();
        
    }
    return response()->json(['success'=>true, 'data'=>$posts]);
    }

    public function getPostById($id){
        $post = Post::with('reviews')->with('tags')->find($id);
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
            $post->tags()->detach();
            $updated = $post->fill($request->all())->save();
            $post->tags()->attach($request->tags);
            if ($updated){
                return response()->json(['success'=>true, 'data'=>$post]);
            }
            else {
                return response()->json(['success'=>false, ' message'=>'Something is wrong upon saving']);
            }

        }
        else {
            return response()->json(['success'=>true, ' message'=>'Post not found!']);
        }

    }

    public function deletePost($id){
        $post = Post::find($id);
        if ($post){
            if ($post->delete()){
                return response()->json(['success'=>true, 'message'=>'Succesfully deleted']);
            }
            else {
                return response()->json(['success'=>false, 'message'=>'Something is wrong']);
            }
        }
        else {
            return response()->json(['success'=>false, 'message'=>'ID not found']);
        }
    }
}

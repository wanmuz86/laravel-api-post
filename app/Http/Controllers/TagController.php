<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class TagController extends Controller
{
    //

    public function create(Request $request){
        $tag = new Tag();
        $tag->name = $request->name;
        if($tag->save()){
            return response()->json(['success'=>true, 'data'=>$tag]);
        }
        else {
            return response()->json(['success'=>false, 'message'=>'Something is wrong']);
        }
    }

    public function getAllTags(){
        $tags = Tag::get();
        return response()->json(['success'=>true, 'data'=>$tags]);
    }
     

}

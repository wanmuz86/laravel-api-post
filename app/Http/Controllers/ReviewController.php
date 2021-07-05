    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Post;

class ReviewController extends Controller
{
//

    public function create($id,Request $request){
        $review = new Review();
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->user_id = 1;

        $post = Post::find($id);
        if ($post){
            if($post->reviews()->save($review)){
                return response()->json(['success'=>true, 'data'=>$post]);

            }
            else {
                return response()->json(['success'=>false, 'message'=>'Something is wrong']);
            }
        }
        else {
         return response()->json(['success'=>false, 'message'=>'Review not found']);
     }


 }

 public function index($id){
    $post = Post::find($id);
    if ($post){
        return response()->json(['success'=>true, 'data'=>$post->reviews]);
    }
    else {
     return response()->json(['success'=>false, 'message'=>'Review not found']);
 }
}

public function show($id,$review_id){
    $review = Review::where('post_id',$id)->where('id',$review_id)->first();
    if ($review){
        return response()->json(['success'=>true, 'data'=>$review]);
    }
    else {
     return response()->json(['success'=>false, 'message'=>'Review not found']);
 }


}
public function update($id,$review_id, Request $request){
    $review = Review::where('post_id',$id)->where('id',$review_id)->first();
    if ($review){
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->user_id = 1;
        if($review->save()){
            return response()->json(['success'=>true, 'message'=>'Review has been updated']);
        }
        else {
            return response()->json(['success'=>false, 'message'=>'Something is wrong']);
        }
    }
    else {
     return response()->json(['success'=>false, 'message'=>'Review not found']);
 }
}
public function delete($id,$review_id){
    $review = Review::where('post_id',$id)->where('id',$review_id)->first();
    if ($review->delete()){
        return response()->json(['success'=>true, 'message'=>'Review has been deleted']);
    }
    else {
        return response()->json(['success'=>false, 'message'=>'Something is wrong']);
    }
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Reply;
use App\Events\LikeEvent;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }
   public function likeIt(Reply $reply)
   {
      $reply->like()->create([
          'user_id' => auth()->id()
      ]);
      broadcast(new LikeEvent($reply->id , 1))->toOthers(); 
   }

   public function unlikeIt(Reply $reply)
   {
       $reply->like()->where('user_id' , auth()->id())->first()->delete();
       broadcast(new LikeEvent($reply->id , 0))->toOthers(); 
   }
}

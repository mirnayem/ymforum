<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Reply;

class LikeController extends Controller
{
   public function likeIt(Reply $reply)
   {
      $reply->like()->create([
          'user_id' => 1
      ]);
   }

   public function unlikeIt(Reply $reply)
   {
       $reply->like()->where('user_id' , 1)->first()->delete();
   }
}

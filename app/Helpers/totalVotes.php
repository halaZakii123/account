<?php

namespace App\Helpers;


use App\OptionPolls;
use Illuminate\Support\Facades\Auth;

class totalVotes
{
    public static function TotalVotes($vote,$id){
         $total_vote =  OptionPolls::where('poll_id',$id)->sum('votes');

         if ($total_vote == 0){
             $votes = $vote/100;
         }else{
             $votes = $vote/$total_vote*100;
         }
         return$votes;
    }
}

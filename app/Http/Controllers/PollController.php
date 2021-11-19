<?php

namespace app\Http\Controllers;

use App\Helpers\checkPermissionHelper;
use App\OptionPolls;
use App\Poll;
use App\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Float_;

class PollController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user_id = checkPermissionHelper::checkPermission();
        $polls = Poll::withCount('options')->where('user_id','=',$user_id)->get();

     return view('poll.index',compact('polls'));

    }

    public function create(){
        return view('poll.pollCurd');
    }

    public function store(Request $request){

        $poll = Poll::create(['question' => $request->question,
                              'status'=>$request->status,
                              'user_id'=>Auth::user()->id,
            ]);
        $details_list=[];

        for ($i = 0; $i < count($request->option); $i++) {
            $details_list[$i]['name'] = $request->option[$i];
        }
        $poll->options()->createMany($details_list);
        return redirect(route('poll.index'));

    }

    public function edit($id){

        $poll =Poll::FindOrFail($id);
            return view('poll.pollCurd',compact('poll'));
    }

    public function update(Request $request , $id){

            $poll = Poll::whereId( $id)->first();
            $poll->update(['question' =>$request->question,
                           'status' => $request->status,
                ]);

            $poll->options()->delete();
            $details_list=[];

            for ($i = 0; $i < count($request->option); $i++) {
                $details_list[$i]['name'] = $request->option[$i];
            }
            $poll->options()->createMany($details_list);
            return redirect(route('poll.index'));

    }
    public function destroy($id){
     $poll= Poll::whereId($id)->first();

     $poll->options()->delete();
     $poll->delete();
     return redirect(route('poll.index'));
    }

    public function getvote(){
        $user_id = checkPermissionHelper::checkPermission();
        $poll = Poll::where('user_id','=',$user_id)->where('status','=',1)->orderby('created_at','desc')->first();

     if ($poll != null){
        $voted = Votes::where('question_id','=',$poll->id)->where('user_id','=',Auth::user()->id)->first();

        if($voted == null){
            return view('poll.vote',compact('poll'));
        }
        else
            return redirect(route('result'));

    }
    else
        return redirect(route('result'));
    }

    public function vote(Request $request ,$id){
     $option = OptionPolls::where('id',$request->option)->first();
        $option->votes = $option->votes+1;
        $option->save();
      $vote = Votes::create([
         'user_id'=>Auth::user()->id,
         'question_id'=>$id,
         'option_id'=> $option->id
     ]);
      return redirect('result');
    }

    public function result(){
        $user_id = checkPermissionHelper::checkPermission();
        $poll = Poll::where('user_id','=',$user_id)->where('status','=',1)->orderby('created_at','desc')->first();
        if ($poll!=null){
        $options = $poll->options()->get();
        $total_vote =0;
        $de =[];
        foreach ($options as $option){
            $total_vote += $option->votes;

        }
        for ($i = 0; $i < count($options); $i++) {
            if ($total_vote == 0)
                $de[$i]['option'] = (int)$options[$i]->votes/100 ;
            else
                $de[$i]['option'] = (int)$options[$i]->votes/$total_vote*100 ;
            $de[$i]['name'] = $options[$i]->name;
        }
        return view('poll.result',compact('poll','de'));}
        else {
            return view('home');
        }
    }

    public function addOption(){
        $x=request()->count;
        return view('poll.addOption',compact('x'));

    }

    public function allResult(){
        $user_id = checkPermissionHelper::checkPermission();
        $polls = Poll::where('user_id','=',$user_id)->where('status','=',1)->get();
        $details=[];
        foreach ($polls as $poll){
            $options = $poll->options()->get();
            $total_vote =0;
            $de =[];

            foreach ($options as $option){
                $total_vote += $option->votes;

            }
            for ($i = 0; $i < count($options); $i++) {
                  if ($total_vote == 0)
                    $de[$i]['option'] = (int)$options[$i]->votes/100 ;
                  else
                      $de[$i]['option'] = (int)$options[$i]->votes/$total_vote*100 ;

                $de[$i]['name'] = $options[$i]->name;
            }

            $details[]=$de;


        }



    return view('poll.allResult',compact('polls','details'));
    }
}

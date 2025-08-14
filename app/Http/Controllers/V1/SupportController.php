<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\BaseController;
use Illuminate\Support\Facades\Validator;
use DB;

class SupportController extends BaseController
{
    public function viewUserTicket(Request $request)
    {
        $data=$this->userTicket($request);
        return $this->sendResponse($data,'Support Page');
        //return $this->sendError('Validation Error.', $vali->errors());
    }

    public function userTicket($request)
    {
        $data['ticketList']=\App\SupportQueries::where([['support_queries.uid',$request->user()->userDetails()->first()->id],['inqid',0]])
        ->select('subject as sub','message as htext','title as title','support_queries.created_at as created_at','status as status')
        ->selectRaw('case when support_queries.status=0 then "New" when support_queries.status=1 then "Replied" when support_queries.status=2 then "Closed" end as status, (support_queries.id*'.pow($request->user()->userDetails()->first()->id, 3).') as ticket_id')
        /*->selectRaw('case when support_queries.status=0 then "status-cancelled" when support_queries.status=1 then "status-pending" when support_queries.status=2 then "status-complete" end as statusclass')*/
        ->get();
        return $data;
    }

    public function userCreateTicket(Request $request)
    {
        $vali=Validator::make($request->all(),[
            'subject' =>['required','string','regex:/^[^<>]+$/u'],
            'message'=>['required','string','regex:/^[^<>]+$/u'],
            'title'=>['required','string','regex:/^[^<>]+$/u'],
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors());
        }
        $insSupprt=\App\SupportQueries::create([
            'uid'=> $request->user()->userDetails()->first()->id,
            'subject'=> $request->subject,
            'title'=> $request->title,
            'message'=> $request->message,
            'status'=> 0,
            'created_at' => now(),
        ]);
        $data=$this->userTicket($request);
        return $this->sendResponse($data,'Query Submitted Successfully.');
    }

    public function viewTicketSingleUser(Request $request,$id)
    {
        $data=$this->singleTicket($request,$id);
        return $this->sendResponse($data,'Ticket Detail');
    }

    public function singleTicket($request,$id){
        $tid=($id/pow($request->user()->userDetails()->first()->id, 3));
        $data['ticket_detail']=\App\SupportQueries::where([['support_queries.uid',$request->user()->userDetails()->first()->id],['support_queries.inqid',$tid]])->orWhere('support_queries.id',$tid)
        ->join('user_details','support_queries.uid','=','user_details.id')
        ->select('subject as subject','message as htext','title as title','support_queries.repliedby as ustatus','support_queries.id as subid','support_queries.created_at as created_at')
        ->selectRaw('(support_queries.id*'.pow($request->user()->userDetails()->first()->id, 3).') as ticket_id')
        /*->selectRaw('case when support_queries.status=0 then "New" when support_queries.status=1 then "Replied" when support_queries.status=2 then "Closed"  end as status')*/
        ->get();
        return $data;
    }

    public function postReplyUser(Request $request){
        $vali=Validator::make($request->all(),[
            'ticket_id' =>['required','integer'],
            'textmsg'=>['required','string','regex:/^[^<>]+$/u'],
        ]);
        if($vali->fails()){
            return $this->sendError('Validation Error.', $vali->errors());
        }
        $tid=($request->ticket_id/pow($request->user()->userDetails()->first()->id, 3));
        $qry="insert into support_queries (uid,inqid,message,status,created_at) values (".$request->user()->userDetails()->first()->id.",".($tid).",'".$request->textmsg."',0,'".now()."')";
        $d=DB::statement($qry);
        $data=$this->singleTicket($request,$request->ticket_id);
        return $this->sendResponse($data,'Reply submitted successfully.');
    }






    public function appUpd(Request $request)
    {
        $data=\App\AppUpdate::where('status',1)->orderBy('id', 'desc')->first();
        return $this->sendResponse($data,'App Update');
    }

    
}

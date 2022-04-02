<?php

namespace App\Http\Controllers;


use App\Http\Resources\ComplaintsResource;
use App\Models\complaint;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Exception;


class ComplaintsController extends Controller
{

    /**
     * Display all complaints
     * @return \Illuminate\Http\Response;
     */
    public function getallComplaints(){
        $complaints=Complaint::paginate(100);
        return $complaints;
    }
    /**
     * Post a complain
     */
    public function postComplaint(Request $request){
       
        try {
        complaint::create($request->all());
        $complaint=new complaint;
        $complaint->user_id= optional(Auth::user())->id;
        // $complaint->area_id= auth()->user()->area_id;
        $complaint->description=$request->description;
        $complaint->longitude=$request->longitude;
        $complaint->latitude=$request->latitude;
        $complaint->address_line_1=$request->address_line_1;
        $complaint->address_line_2=$request->address_line_2;
        $complaint->save();
        return response(201);
       
        } catch (Exception $th) 
        {
            return response($th->getMessage());
        }
        
    }
    /**
     * get a complaints
     */
    public function getComplaintById($user_id){
        $complaint = Complaint::find($user_id);
        return $complaint;
    }
     
   
}

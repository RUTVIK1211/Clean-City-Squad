<?php

namespace App\Http\Controllers;


use App\Http\Resources\ComplaintsResource;
use App\Models\complaint;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use Illuminate\Validation\ValidationException;


class ComplaintsController extends Controller
{

   
    /**
     * Post a complain
     */
    public function postComplaint(Request $request)
    {
        \DB::beginTransaction();
        try {
            $request->validate([
                'image' => 'required',
                'description' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'address_line_1' => 'required',
                'address_line_2' => 'required',
                'area_id' => 'required',
                'complaint_type_id' => 'required'
            ]);

            $request['user_id'] = auth()->user()->id;
          //  $request['area_id'] = auth()->user()->area_id;

            $complaint = complaint::create($request->all());
            
            if($complaint){
                if($files=$request->file('image')){
                    $saveFlag = true;
                    foreach($files as $file){
                        $var = date_create();
                        $time = date_format($var, 'YmdHis');
                        $imageName = $time . '-' . $file->getClientOriginalName();
                        $file->move(public_path('image'), $imageName);
                        $complaint_resource['complaint_id'] = $complaint->id;
                        $complaint_resource['image_url'] = $imageName;
                        $complaint_resource_created = Resource::create($complaint_resource);
                        if(!$complaint_resource_created){
                            $saveFlag = false;
                        }
                    }
                    if($saveFlag){
                        \DB::commit();   
                    } else{
                        \DB::rollback();
                    }
                }
                return response()->json(['message' => 'Post created successfully'], 200);
            } else{
                return response()->json(['error' => 'Something went wrong'], 500);
            }
        
        } catch (Exception $th) {
            \DB::rollback();
            return response($th->getMessage());
        } catch (ValidationException $th) {
            return response($th->errors());
        }
        
    }
    /**
     * get a complaints
     */
    public function getComplaintById($user_id){
        try {
            $complaints = Complaint::with('Resources')->where('user_id',$user_id)->get();
            if(count($complaints) > 0 ){
                foreach($complaints as $complaint){
                    foreach($complaint->Resources as $resource){
                        $resource->image_url = public_path('image').$resource->image_url;
                    }
                    $complaint['resources'] = $complaint->Resources;
                }
                return $complaints;
            } else{
                return response()->json(['error' => 'oops complaint dose not exist'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * get a complaint
     */
    public function updateComplaint(Request $request,$id){
        try {
            $complaint = complaint::find($id);
            if($complaint){
                if($complaint->update($request->all())){
                    return complaint::findOrFail($id);   
                } else{
                    return response()->json(['error' => 'Somthing went wrong..'], 500);
                }
            } else{
                return response()->json(['error' => 'oops complaint dose not exist'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     /**
     *delete a complaint
     */
    public function deleteComplaint($id)
    {
        try {
            $complaint = complaint::find($id);
            if($complaint){
                if($complaint->delete()){
                    return response()->json(['message' => 'Deleted successfully'], 200);
                }else{
                    return response()->json(['error' => 'Somthing went wrong..'], 500);
                }
            } else{
                return response()->json(['error' => 'oops complaint dose not exist'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     /**
     * get a complaints
     */
    public function getallComplaints(){
        try {
            $complaints = Complaint::with('Resources')->get();
            if(count($complaints) > 0 ){
                foreach($complaints as $complaint){
                    foreach($complaint->Resources as $resource){
                        $resource->image_url = public_path('image').$resource->image_url;
                    }
                    $complaint['resources'] = $complaint->Resources;
                }
                return $complaints;
            } else{
                return response()->json(['error' => 'oops table is empty'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
   
}

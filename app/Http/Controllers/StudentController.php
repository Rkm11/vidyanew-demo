<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Student;
use App\Models\ParentDetail;
use App\Models\AdmissionDetail;
use App\Http\Traits\GetData;
use DataTables;
use DB;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    use GetData;

    protected $pre = 'enq_';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('view_students');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    // public function data(Request $r)
    // {
    //     // return $r;
    //     // $stu = Student::select(['students.stu_id', 'students.stu_first_name', 'students.stu_last_name','students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'admission_details.ad_school', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id' ,'admission_details.created_at',DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS name')])->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')->join('parent_details', 'parent_details.parent_id','=','students.stu_parent')->join('standards', 'standards.std_id','=','admission_details.ad_standard');

    //     // $stu = Student::select(['students.stu_id', 'students.stu_uid','students.stu_first_name', 'students.stu_last_name','students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id','admission_details.ad_school','admission_details.created_at',DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('admission_details','admission_details.ad_student','=','students.stu_id')->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent');        
        
    //     $stu = Student::select(['students.stu_id', 'students.stu_uid','students.stu_first_name', 'students.stu_last_name','students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'admission_details.ad_school', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id', 'admission_details.ad_fees','admission_details.ad_remaining_fees','admission_details.created_at',DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
    //     ->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
    //     ->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')        
    //     ->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard');

    //     // return DataTables::of($enq)->make(true);
    //     if($r->batch){
    //         if($r->batch != '-1'){
    //             $stu->where('admission_details.ad_batch', $r->batch);
    //         }
    //     }
    //     if($r->standard){
    //         if($r->standard != '-1'){
    //             $stu->where('admission_details.ad_standard', $r->standard);
    //         }
    //     }
    //     if($r->medium){
    //         if($r->medium != '-1'){
    //             $stu->where('admission_details.ad_medium', $r->medium);
    //         }
    //     }
    //     if($r->subject){
    //         if($r->subject != '-1'){
    //             $stu->whereRaw('FIND_IN_SET('.$r->subject.',ad_subjects)');            
    //         }
    //     }
    //     $stu->where('admission_details.ad_status', 1)->get();
    //     return DataTables::of($stu)->make(true);        
    // }


    public function data(Request $r)
    {        
        $enq = Student::select(['*',DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
        ->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
        ->join('enquiries', 'enquiries.enq_admission' ,'=','admission_details.ad_id')
        ->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
        ->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')        
        ->where('admission_details.ad_status', 1);
        if($r->batch){
            if($r->batch != '-1'){
                $stu->where('admission_details.ad_batch', $r->batch);
            }
        }
        if($r->standard){
            if($r->standard != '-1'){
                $stu->where('admission_details.ad_standard', $r->standard);
            }
        }
        if($r->medium){
            if($r->medium != '-1'){
                $stu->where('admission_details.ad_medium', $r->medium);
            }
        }
        if($r->subject){
            if($r->subject != '-1'){
                $stu->whereRaw('FIND_IN_SET('.$r->subject.',ad_subjects)');            
            }
        }
        $enq->get();

        return DataTables::of($enq)->filterColumn('stu_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(students.stu_first_name, \" \" , students.stu_last_name) like ?", ["%{$keyword}%"]);
            })->make(true);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

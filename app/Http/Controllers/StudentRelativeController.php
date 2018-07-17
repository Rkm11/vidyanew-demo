<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRelative;
use App\Http\Traits\GetData;

class StudentRelativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    use GetData;
    protected $pre = 'sr_';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $data = [];
        $n = $this->changeKeys($this->pre, $r->all());
        // return $n;
        if(StudentRelative::create($n)){ 
            $s = StudentRelative::where('sr_student',$n['sr_student'])->get();
            $data['s'] = $s;
            $data['msg'] = 'success';
            return $data;
        }else{
            return 'error';
        }

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

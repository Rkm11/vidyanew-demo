<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Http\Traits\GetData;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    use GetData;

    protected $pre = 'school_';
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
        return view('create_school');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // return $this->insertSmall($r, $this->pre, 'School');
        if(!School::where($this->pre.'name',$r->name)->first()){
            $n = $this->changeKeys($this->pre, $r->all());
            if(isset($r->fetch)){
                $s = School::create($n);
                return $s ? $s : 'error';                
            }
            return School::create($n) ? 'success' : 'error';
        }else{
            return 'exist';
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

    public function findSchool(Request $r){
        return School::where($this->pre.'name', 'like', $r->find.'%')->get();
    }
}

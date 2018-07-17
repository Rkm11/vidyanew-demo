<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Traits\GetData;
use DataTables;
class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    use GetData;

    protected $pre = 'sub_';
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
        return view('create_subject');        
    }
    public function data(Request $r)
    {
        // return $r->all();
        $sub = Subject::where('sub_std', $r->id)->get();
        return DataTables::of($sub)->make(true);
    }

    public function getData(Request $r)
    {
        // return $r->all();
        return $sub = Subject::where('sub_std', $r->id)->get();        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!Subject::where($this->pre.'name',$r->name)->first()){
            $n = $this->changeKeys($this->pre, $r->all());
            return Subject::create($n) ? 'success' : 'error';
        // }else{
        //     return 'exist';
        // }
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
        Subject::find($id)->delete() ? 'success' : 'error';
    }
}

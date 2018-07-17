<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreviousDetail;
use App\Http\Traits\GetData;

class PreviousController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    use GetData;    
    protected $pre = 'pd_';
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
        $total = 0;
        foreach ($r->mark as $key => $value) {
            if($value){
                $total = $total+$value;
            }
        }
        $data['total'] = $total;
        $data['sub'] = count($r->mark);
        $data['msg'] = 'success';
        $n = $this->changeKeys($this->pre, $r->all());
        $n['pd_test'] = json_encode($r->mark);
        return PreviousDetail::create($n) ? $data: 'error';
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

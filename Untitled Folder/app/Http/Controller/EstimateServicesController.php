<?php

namespace App\Http\Controllers;

use App\Models\Estimate_services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimateServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function store(Request $request)
    {
        $id = $request->id;
        if (Estimate_services::where('id_services', '=', $id)->exists()) {
            $post= Estimate_services::where('id_services', $id)->update([
                'id_estimate' => $request->id_e,
                'jasa' => $request->jasa,
                'note' => $request->note,
                'qty' => $request->qty,
                'price_s' => $request->price_s,
                'diskon_dpp_s' => 0,
                'markup_s' => $request->markup_s,
                'price_asuransi_s' => 0,
                'diskon_asuransi_s' => 0,
            ]);
        }else{
            $post= Estimate_services::create([
                'id_estimate' => $request->id_e,
                'jasa' => $request->jasa,
                'note' => $request->note,
                'qty' => $request->qty,
                'price_s' => $request->price_s,
                'diskon_dpp_s' => 0,
                'markup_s' => $request->markup_s,
                'price_asuransi_s' => 0,
                'diskon_asuransi_s' => 0,
            ]);
        }
    return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate_services  $estimate_services
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate_services $estimate_services)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate_services  $estimate_services
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id_services' => $id);
        $post  = Estimate_services::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate_services  $estimate_services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate_services $estimate_services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate_services  $estimate_services
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Estimate_services::where('id_services',$id)->delete();
        return response()->json($post);
    }
}

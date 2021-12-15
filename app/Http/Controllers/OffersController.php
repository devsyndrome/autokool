<?php

namespace App\Http\Controllers;

use App\Models\Estimates;
use App\Models\Estimate_parts;
use App\Models\Estimate_services;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OffersController extends Controller
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
    public function index(Request $request)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        $list_estimates = Estimates::where('status','Penawaran')->get();
        if($request->ajax()){
            return datatables()->of($list_estimates)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post">Cetak</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.url('penawaran').'/detail/'.$data->id.'" class="btn btn-outline-success btn-sm">Detail</a>';
                $button .= '&nbsp;&nbsp;'; 
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('penawaran',compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id_e;
        $status = $request->status;
        $post= Estimates::where('id', $id)->update([
            'status' => $status,
        ]);
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return view('user');        
    }

    public function cetak(Request $request)
    {
        $id = $request->id;        
        $estimates = Estimates::where('id',$request->id)->first();
        $kepada = $request->kepada;
        $pengirim = $request->pengirim;
        $estimates = Estimates::where('id',$id)->first();
        $jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_s)+(ROUND(price_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
        $part = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
        return view('cetak-penawaran',compact('estimates','kepada','pengirim','jasa','part'));     
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function show(Estimates $estimates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Estimates::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimates $estimates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimates $estimates)
    {
        //
    }

    public function detail(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        $estimates = Estimates::where('id',$id)->first();
        $jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_s)+(ROUND(price_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
        $part = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
        $totaljasa = Estimate_services::selectRaw('SUM(price_s * qty) as total')->where('id_estimate',$id)->first();
        $totalpart = Estimate_parts::selectRaw('SUM(price_p * qty) as total')->where('id_estimate',$id)->first();
        $totalqty_s = Estimate_services::selectRaw('SUM(qty) as sqty')->where('id_estimate',$id)->first();
        $totalprice_s = Estimate_services::selectRaw('SUM(price_s) as sprice_s')->where('id_estimate',$id)->first();
        $totalqty_p = Estimate_parts::selectRaw('SUM(qty) as pqty')->where('id_estimate',$id)->first();
        $totalprice_p = Estimate_parts::selectRaw('SUM(price_p) as sprice_p')->where('id_estimate',$id)->first();
        return view('detail-penawaran',compact('menu','id','estimates','jasa','part','totaljasa','totalpart','totalqty_s','totalqty_p','totalprice_s','totalprice_p'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Estimate_parts;
use App\Models\Estimate_services;
use App\Models\UserMenu;
use App\Models\Estimates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PenawaranHppController extends Controller
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
        $list_estimates = Estimates::where('status','Asuransi')->get();
        if($request->ajax()){
            return datatables()->of($list_estimates)
            ->addColumn('action', function($data){
                $button = '<a href="'.url('penawaran-hpp').'/detail/'.$data->id.'" class="btn btn-outline-info btn-sm">Check Gross Margin</a>';
                $button .= '&nbsp;&nbsp;';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('penawaran-hpp',compact('menu'));
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
        //
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
    public function edit(Estimates $estimates)
    {
        //
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
        return view('margin-penawaran-hpp',compact('menu','id','estimates','jasa','part','totaljasa','totalpart','totalqty_s','totalqty_p','totalprice_s','totalprice_p'));
    }
}

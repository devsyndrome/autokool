<?php

namespace App\Http\Controllers;

use App\Models\Estimate_parts;
use App\Models\Estimate_services;
use App\Models\Estimates;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsuransiController extends Controller
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
                $button = '<a href="'.url('asuransi').'/part/'.$data->id.'" class="btn btn-outline-info btn-sm">SPK Part</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.url('asuransi').'/jasa/'.$data->id.'" class="btn btn-outline-primary btn-sm">SPK Jasa</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.url('asuransi').'/detail/'.$data->id.'" class="btn btn-outline-success btn-sm">Detail</a>';
                $button .= '&nbsp;&nbsp;'; 
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('asuransi',compact('menu'));
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
        $id = $request->id;
        if($request->jenis == "part"){
            $post= Estimate_parts::where('id_part', $id)->update([
                'price_asuransi_p' => $request->price,
                'diskon_asuransi_p' => $request->diskon,
            ]);
        }else{
            $post= Estimate_services::where('id_services', $id)->update([
                'price_asuransi_s' => $request->price,
                'diskon_asuransi_s' => $request->diskon,
            ]);
        }
            
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function show(estimates $estimates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function edit(estimates $estimates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estimates $estimates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estimates  $estimates
     * @return \Illuminate\Http\Response
     */
    public function destroy(estimates $estimates)
    {
        //
    }
    public function part(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        if($request->ajax()){
            $list_parts = Estimate_parts::select('*',Estimate_parts::raw('(price_asuransi_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_asuransi_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_asuransi_p / 1.1)-(ROUND(price_asuransi_p / 1.1 * (diskon_asuransi_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_asuransi_p / 1.1)-(ROUND(price_asuransi_p / 1.1 * (diskon_asuransi_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
            return datatables()->of($list_parts)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id_part.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post">SPK</i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $estimates = Estimates::where('id',$id)->first();
        return view('part-asuransi',compact('id','estimates','menu'));
    }
    public function jasa(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        if($request->ajax()){
            $list_jasa = Estimate_services::select('*',Estimate_services::raw('(price_asuransi_s * qty) AS subtotal'),Estimate_services::raw('(price_asuransi_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_asuransi_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_asuransi_s / 1.1)-(ROUND(price_asuransi_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_asuransi_s / 1.1)-(ROUND(price_asuransi_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_asuransi_s)+(ROUND(price_asuransi_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
            return datatables()->of($list_jasa)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id_services.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post">SPK</i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $estimates = Estimates::where('id',$id)->first();
        return view('services-asuransi',compact('id','estimates','menu'));
    }
    public function detail(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        $estimates = Estimates::where('id',$id)->first();
        $jasa = Estimate_services::select('*',Estimate_services::raw('(price_asuransi_s * qty) AS subtotal'),Estimate_services::raw('(price_asuransi_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_asuransi_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_asuransi_s / 1.1)-(ROUND(price_asuransi_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_asuransi_s / 1.1)-(ROUND(price_asuransi_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_asuransi_s)+(ROUND(price_asuransi_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
        $part = Estimate_parts::select('*',Estimate_parts::raw('(price_asuransi_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_asuransi_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_asuransi_p / 1.1)-(ROUND(price_asuransi_p / 1.1 * (diskon_asuransi_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_asuransi_p / 1.1)-(ROUND(price_asuransi_p / 1.1 * (diskon_asuransi_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
        $totaljasa = Estimate_services::selectRaw('SUM(price_s * qty) as total')->where('id_estimate',$id)->first();
        $totalpart = Estimate_parts::selectRaw('SUM(price_p * qty) as total')->where('id_estimate',$id)->first();
        $totalqty_s = Estimate_services::selectRaw('SUM(qty) as sqty')->where('id_estimate',$id)->first();
        $totalprice_s = Estimate_services::selectRaw('SUM(price_s) as sprice_s')->where('id_estimate',$id)->first();
        $totalqty_p = Estimate_parts::selectRaw('SUM(qty) as pqty')->where('id_estimate',$id)->first();
        $totalprice_p = Estimate_parts::selectRaw('SUM(price_p) as sprice_p')->where('id_estimate',$id)->first();
        return view('detail-asuransi',compact('menu','id','estimates','jasa','part','totaljasa','totalpart','totalqty_s','totalqty_p','totalprice_s','totalprice_p'));
    }
}

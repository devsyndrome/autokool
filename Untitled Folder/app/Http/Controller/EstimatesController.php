<?php

namespace App\Http\Controllers;

use App\Models\Estimate_parts;
use App\Models\Estimate_services;
use App\Models\Estimates;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimatesController extends Controller
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
        $list_estimates = Estimates::get();
        if($request->ajax()){
            return datatables()->of($list_estimates)
            ->addColumn('action', function($data){
                $button = '<a href="'.url('estimasi').'/detail/'.$data->id.'" class="btn btn-outline-success btn-sm"><i class="fa fa-info-circle"></i></a>';
                $button .= '&nbsp;';
                if($data->status == "Estimasi"){
                $button .= '<a href="'.url('estimasi').'/part/'.$data->id.'" class="btn btn-outline-info btn-sm"><i class="fa fa-keyboard"></i></a>';
                $button .= '&nbsp;';
                // $button .= '<a href="'.url('estimasi').'/jasa/'.$data->id.'" class="btn btn-outline-primary btn-sm">Jasa</a>';
                // $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                }     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('estimates',compact('menu'));
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
        if (Estimates::where('id', '=', $id)->exists()) {
            $post= Estimates::where('id', $id)->update([
                'tgl' => $request->tgl,
                'surveyor' => $request->surveyor,
                'asuransi' => $request->asuransi,
                'nopol' => $request->nopol,
                'type' => $request->type,
                'tahun' => $request->tahun,
                'warna' => $request->warna,
                'norangka' => $request->norangka,
                'nomesin' => $request->nomesin,
                'nama_tertanggung' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'status' => 'Estimasi',
            ]);
        }else{
            $post= Estimates::create([
                'tgl' => $request->tgl,
                'surveyor' => $request->surveyor,
                'asuransi' => $request->asuransi,
                'nopol' => $request->nopol,
                'type' => $request->type,
                'tahun' => $request->tahun,
                'warna' => $request->warna,
                'norangka' => $request->norangka,
                'nomesin' => $request->nomesin,
                'nama_tertanggung' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'status' => 'Estimasi',
            ]);
        }
    return response()->json($post);
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
    public function destroy($id)
    {
        $post = Estimates::where('id',$id)->delete();
        Estimate_parts::where('id_estimate',$id)->delete();
        Estimate_services::where('id_estimate',$id)->delete();
        return response()->json($post);
    }

    public function part(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        if($request->ajax()){
            $list_parts = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
            return datatables()->of($list_parts)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id_part.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id_part.'" class="delete btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $estimates = Estimates::where('id',$id)->first();
        return view('part',compact('id','estimates','menu'));
    }
    public function jasa(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        if($request->ajax()){
            $list_jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_s)+(ROUND(price_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
            return datatables()->of($list_jasa)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id_services.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post-jasa"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="hapus" id="'.$data->id_services.'" class="hapus btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $estimates = Estimates::where('id',$id)->first();
        return view('services',compact('id','estimates','menu'));
    }
    public function detail(Request $request,$id)
    {
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        $estimates = Estimates::where('id',$id)->first();
        $jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('(price_s * qty) AS subtotal'),Estimate_services::raw('ROUND(price_s / 1.1) AS price_dpp'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) as netto'),Estimate_services::raw('(ROUND(price_s / 1.1)-(ROUND(price_s / 1.1 * (diskon_dpp_s / 100)))) * qty as subtotal_dpp'),Estimate_services::raw('(ROUND(price_s)+(ROUND(price_s * (markup_s / 100)))) as after'))->where('id_estimate',$id)->get();
        $part = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'),Estimate_parts::raw('ROUND(price_p / 1.1) AS price_dpp'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) as netto'),Estimate_parts::raw('(ROUND(price_p / 1.1)-(ROUND(price_p / 1.1 * (diskon_dpp_p / 100)))) * qty as subtotal_dpp'),Estimate_parts::raw('(ROUND(price_p)+(ROUND(price_p * (markup_p / 100)))) as after'))->where('id_estimate',$id)->get();
        $totalqty_s = Estimate_services::selectRaw('SUM(qty) as sqty')->where('id_estimate',$id)->first();
        $totalprice_s = Estimate_services::selectRaw('SUM(price_s) as sprice_s')->where('id_estimate',$id)->first();
        $totalqty_p = Estimate_parts::selectRaw('SUM(qty) as pqty')->where('id_estimate',$id)->first();
        $totalprice_p = Estimate_parts::selectRaw('SUM(price_p) as sprice_p')->where('id_estimate',$id)->first();
        $totaljasa = Estimate_services::selectRaw('SUM(price_s * qty) as total')->where('id_estimate',$id)->first();
        $totalpart = Estimate_parts::selectRaw('SUM(price_p * qty) as total')->where('id_estimate',$id)->first();
        
        return view('detail-estimasi',compact('menu','id','estimates','jasa','part','totaljasa','totalpart','totalqty_s','totalqty_p','totalprice_s','totalprice_p'));
    }
}

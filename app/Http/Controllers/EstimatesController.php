<?php

namespace App\Http\Controllers;

use App\Models\Estimate_parts;
use App\Models\Estimate_services;
use App\Models\Estimates;
use Illuminate\Http\Request;

class EstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_estimates = Estimates::all();
        if($request->ajax()){
            return datatables()->of($list_estimates)
            ->addColumn('action', function($data){
                $button = '<a href="'.url('estimasi').'/part/'.$data->id.'" class="btn btn-outline-info btn-sm">Part</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.url('estimasi').'/jasa/'.$data->id.'" class="btn btn-outline-primary btn-sm">Jasa</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.url('estimasi').'/detail/'.$data->id.'" class="btn btn-outline-success btn-sm">Detail</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('estimates');
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
                'asuransi' => $request->asuransi,
                'nopol' => $request->nopol,
                'type' => $request->type,
                'tahun' => $request->tahun,
                'nama_tertanggung' => $request->nama,
                'status' => 'Estimasi',
            ]);
        }else{
            $post= Estimates::create([
                'tgl' => $request->tgl,
                'asuransi' => $request->asuransi,
                'nopol' => $request->nopol,
                'type' => $request->type,
                'tahun' => $request->tahun,
                'nama_tertanggung' => $request->nama,
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
        return response()->json($post);
    }

    public function part(Request $request,$id)
    {
        
        if($request->ajax()){
            $list_parts = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'))->where('id_estimate',$id)->get();
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
        return view('part',compact('id','estimates'));
    }
    public function jasa(Request $request,$id)
    {
        if($request->ajax()){
            $list_jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'))->where('id_estimate',$id)->get();
            return datatables()->of($list_jasa)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id_services.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id_services.'" class="delete btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $estimates = Estimates::where('id',$id)->first();
        return view('services',compact('id','estimates'));
    }
    public function detail(Request $request,$id)
    {
        $estimates = Estimates::where('id',$id)->first();
        $jasa = Estimate_services::select('*',Estimate_services::raw('(price_s * qty) AS subtotal'))->where('id_estimate',$id)->get();
        $part = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'))->where('id_estimate',$id)->get();
        $totaljasa = Estimate_services::selectRaw('SUM(price_s * qty) as total')->where('id_estimate',$id)->first();
        $totalpart = Estimate_parts::selectRaw('SUM(price_p * qty) as total')->where('id_estimate',$id)->first();
        
        return view('detail-estimasi',compact('id','estimates','jasa','part','totaljasa','totalpart'));
    }
}

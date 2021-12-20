<?php

namespace App\Http\Controllers;

use App\Models\Estimate_parts;
use App\Models\Estimates;
use Illuminate\Http\Request;

class EstimatePartsController extends Controller
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
        if($request->ajax()){
            $list_parts = Estimate_parts::select('*',Estimate_parts::raw('(price_p * qty) AS subtotal'))->get();
            return datatables()->of($list_parts)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-outline-warning btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id_e;
        $post= Estimates::where('id', $id)->update([
            'status' => 'Logistik',
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
        if (Estimate_parts::where('id_part', '=', $id)->exists()) {
            $post= Estimate_parts::where('id_part', $id)->update([
                'id_estimate' => $request->id_e,
                'nopart' => $request->nopart,
                'sparepart' => $request->sparepart,
                'qty' => $request->qty,
                'price_p' => $request->price_p,
                'diskon_dpp_p' => 0,
                'markup_p' => $request->markup_p,
                'price_asuransi_p' => 0,
                'diskon_asuransi_p' => 0,
            ]);
        }else{
            $post= Estimate_parts::create([
                'id_estimate' => $request->id_e,
                'nopart' => $request->nopart,
                'sparepart' => $request->sparepart,
                'qty' => $request->qty,
                'price_p' => $request->price_p,
                'diskon_dpp_p' => 0,
                'markup_p' => $request->markup_p,
                'price_asuransi_p' => 0,
                'diskon_asuransi_p' => 0,
            ]);
        }
    return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate_parts  $estimate_parts
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate_parts $estimate_parts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate_parts  $estimate_parts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id_part' => $id);
        $post  = Estimate_parts::where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate_parts  $estimate_parts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate_parts $estimate_parts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate_parts  $estimate_parts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Estimate_parts::where('id_part',$id)->delete();
        return response()->json($post);
    }

    
}

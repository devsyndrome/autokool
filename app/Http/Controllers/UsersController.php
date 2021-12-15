<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
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
        $list_users = user::all();
        $menu  = UserMenu::where('id_user',Auth::user()->id)->first();
        $user_menus = User::join('user_menus', 'users.email', '=', 'user_menus.id_user')->get();
        if($request->ajax()){
            return datatables()->of($list_users)
            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0) " data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';     
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('user',compact('menu'));
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
        $idrand = rand(1,999);
            if (User::where('id', '=', $id)->exists()) {
                $post= User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $post= UserMenu::where('id_user', $id)->update([
                    'user' => $request->has('user'),
                    'estimasi' => $request->has('estimasi'),
                    'spk' => $request->has('spk'),
                    'logistik' => $request->has('logistik'),
                    'penawaran' => $request->has('penawaran'),
                    'penawaranhpp' => $request->has('penawaranhpp'),
                    'spkhpp' => $request->has('spkhpp'),
                ]);
            }else{
                $post= User::create([
                    'id' => $idrand,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $post= UserMenu::create([
                    'id_user' => $idrand,
                    'user' => $request->has('user'),
                    'estimasi' => $request->has('estimasi'),
                    'spk' => $request->has('spk'),
                    'logistik' => $request->has('logistik'),
                    'penawaran' => $request->has('penawaran'),
                    'penawaranhpp' => $request->has('penawaranhpp'),
                    'spkhpp' => $request->has('spkhpp'),
                ]);
            }
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('users.id' => $id);
        $post  = User::join('user_menus', 'users.id', '=', 'user_menus.id_user')->where($where)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = User::where('id',$id)->delete();
        UserMenu::where('id_user',$id)->delete();
        
        return response()->json($post);
    }
}

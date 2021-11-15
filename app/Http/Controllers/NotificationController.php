<?php

namespace App\Http\Controllers;

use App\Models\MlUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = MlUser::find($_SESSION['user']);
        // if(in_array($_SESSION['profil'],array(1,2))){
        //     return view('admin.notifications',compact('user'));

        // }
        // elseif(in_array($_SESSION['profil'],array(3,4))){

        //     return view('admin.notifications',compact('user'));

        // }
        return view('admin.notifications',compact('user'));
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
    public function notificationsMarkAsRead(Request $request,$id){
        // $id = $request->input('id');
        $user = MlUser::find($_SESSION['user']);
        $req = $user->unreadNotifications->when($id, function ($query) use ($id) {
            return $query->where('id', $id);
        })->markAsRead();
        if(is_null($req)){

            $message = 'success' ;

        }else{
            $message = 'error' ;
        }
        return  json_encode([
            'message' => $message,
            'id' => $id
            // 'message' => 'id'

        ]) ;

    }
}

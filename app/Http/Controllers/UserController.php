<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = \App\User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|unique:users|max:255',
                    'phone' => 'required|unique:users|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('users/create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $user = new \App\User;
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->isAdmin = $request->get('isAdmin');
        $user->password = bcrypt($request->get('password'));
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect('users')->with('success', 'User has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = \App\User::find($id);
        return view('users.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validate_fields = [];
         if (($request->old_email != $request->email)) {
             $validate_fields['email'] = 'required|unique:users|max:255';
         }
         
         if (($request->old_phone != $request->phone)) {
             $validate_fields['phone'] = 'required|unique:users|max:10';
         }
         
        if (($request->old_email != $request->email)) {
            $validator = Validator::make($request->all(), $validate_fields);

            if ($validator->fails()) {
                return redirect('users/' . $id . '/edit')
                                ->withErrors($validator)
                                ->withInput();
            }
        }
        $user = \App\User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->isAdmin = $request->get('isAdmin');
        $user->password = bcrypt($request->get('password'));
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect('users')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = \App\User::find($id);
        $user->delete();
        return redirect('users')->with('success', 'User has been deleted');
    }

}

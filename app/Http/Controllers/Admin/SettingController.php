<?php

namespace App\Http\Controllers\Admin;

use App\Action\UserActions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', compact('user'));
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

    public function updateUser(Request $request, $id)
    {
        try {
            //code...
            $user = UserActions::updateAdminProdile($request, $id);
            if ($user) {
                # code...
                return redirect()->route('admin.settings.index')->with('success', 'Successfully Updated User');
            }
            return redirect()->back()->with('error', 'An error occured while updating User');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            if ($request->password != $request->renewpassword) {
                # code...
                return redirect()->back()->with('error', 'Passwords Mismatch');
            }
            //code...
            $user = UserActions::updateAdminPassword($request);
            if ($user) {
                # code...
                return redirect()->route('admin.settings.index')->with('success', 'Successfully Updated Password');
            }
            return redirect()->back()->with('error', 'An error occured while updating Password');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

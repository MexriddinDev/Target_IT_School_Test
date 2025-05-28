<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers;

use App\Http\Controllers\API\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return Admin::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string',

        ]);
        $validated['password'] = bcrypt($validated['password']);
        return Admin::create($validated);

    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}

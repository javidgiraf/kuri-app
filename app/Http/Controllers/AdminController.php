<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('is_admin', true)->paginate(10);

        return view('admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdminRequest $request)
    {
        $inputs = $request->all();
        $admin = User::create($inputs);
        $admin->assignRole('admin');

        return redirect()->route('admins.index')->with('success', 'Admin Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $admin = User::findOrFail($id);
        
        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $inputs = $request->all();
        User::findOrFail($id)->update($inputs);

        return redirect()->route('admins.index')->with('success', 'Admin Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}

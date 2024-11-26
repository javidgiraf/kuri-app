<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoldService;
use App\Models\GoldRate;
use App\Helpers\LogActivity;
use App\Http\Requests\GoldPostRequest;

class GoldrateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GoldService $goldService)
    {
        //

        $goldrates = $goldService->getGoldRates();
        $goldrate_by_id = GoldRate::latest()->first();

        $goldrate = $goldService->getGoldRate($goldrate_by_id->id);
        return view('goldrates.index', compact('goldrate', 'goldrates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, GoldPostRequest $request, GoldService $goldService)
    {
        //
        $id = decrypt($id);
        $input = $request->all();
        $goldrate = $goldService->getGoldRate($id);
        $goldService->updateGoldRate($goldrate, $input);
        LogActivity::addToLog('Goldrate  updated today by ' . auth()->user()->name);
        return redirect()->route('goldrates.index')->with('success', 'Gold rate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

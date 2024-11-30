<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogActivity;
use App\Http\Requests\DistrictPostRequest;
use App\Services\DistrictService;
use App\Services\StateService;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DistrictService $districtService)
    {
        $districts = $districtService->getDistricts(20);

        return view('districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StateService $stateService)
    {
        //
        $states = $stateService->getStates();

        return view('districts.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictPostRequest $request, DistrictService $districtService)
    {
        //
        $input = $request->all();
        $districtService->createDistrict($input);
        LogActivity::addToLog('New District ' . $input['name'] . ' Added by' . auth()->user()->name);
        return redirect()->route('districts.index')->with('success', 'District Added successfully');
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
    public function edit(string $id, StateService $stateService, DistrictService $districtService)
    {
        //
        $id = decrypt($id);
        $states = $stateService->getStates();
        $district = $districtService->getDistrict($id);
        return view('districts.edit', compact('district', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictPostRequest $request, string $id, DistrictService $districtService)
    {
        //
        $id = decrypt($id);
        $input = $request->all();
        $district = $districtService->getDistrict($id);
        $districtService->updateDistrict($district, $input);
        LogActivity::addToLog('District ' . $input['name'] . ' updated by ' . auth()->user()->name);
        return redirect()->route('districts.index')->with('success', 'District Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DistrictService $districtService)
    {
        //
        $id = decrypt($id);
        $district = $districtService->getDistrict($id);
        $districtService->deleteDistrict($district);
        LogActivity::addToLog('District ' . $district->name . ' removed by ' . auth()->user()->name);
        return redirect()->route('districts.index')->with('success', 'District Deleted Successfully');
    }
}

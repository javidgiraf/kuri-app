<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CountryService;
use App\Services\StateService;
use App\Helpers\LogActivity;
use App\Http\Requests\StatePostRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StateService $stateService)
    {
        $states = $stateService->getStates(20);

        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CountryService $countryService)
    {
        //
        $countries = $countryService->getCountries();
        return view('states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatePostRequest $request, StateService $stateService)
    {
        //
        $input = $request->all();
        $stateService->createState($input);
        LogActivity::addToLog('New State ' . $input['name'] . ' Added by' . auth()->user()->name);
        return redirect()->route('states.index')->with('success', 'State Added successfully');
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
    public function edit(string $id, CountryService $countryService, StateService $stateService)
    {
        //
        $id = decrypt($id);
        $state = $stateService->getState($id);
        $countries = $countryService->getCountries();
        return view('states.edit', compact('countries', 'state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatePostRequest $request, string $id, StateService $stateService)
    {
        //
        $id = decrypt($id);
        $input = $request->all();
        $state = $stateService->getState($id);
        $stateService->updateState($state, $input);
        LogActivity::addToLog('State ' . $input['name'] . ' updated by ' . auth()->user()->name);
        return redirect()->route('states.index')->with('success', 'State Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, StateService $stateService)
    {
        //
        $id = decrypt($id);
        $state = $stateService->getState($id);
        $stateService->deleteState($state);
        LogActivity::addToLog('State ' . $state->title . ' removed by ' . auth()->user()->name);
        return redirect()->route('states.index')->with('success', 'State Deleted successfully');
    }
    public function getDistricts(Request $request, StateService $stateService)
    {
        $input = $request->all();
        $state_id = $input['state_id'];
        $districts = $stateService->getDistrictsbyState($state_id);
        if ($input['district_id'] == "") {
            $data2 =  view('partials._districts')
                ->with(compact('districts'))
                ->render();
        } else {
            $district_id = $input['district_id'];
            $data2 =  view('partials._districts')
                ->with(compact('districts', 'district_id'))
                ->render();
        }

        return response()->json(['data' => $data2]);
    }
}

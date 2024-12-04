<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CountryService;
use App\Helpers\LogActivity;
use App\Http\Requests\CountryPostRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CountryService $countryService)
    {
        //
        $countries = $countryService->getCountries();
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryService $countryService, CountryPostRequest $request)
    {
        //
        $input = $request->all();
        $country = $countryService->createCountry($input);
        LogActivity::addToLog('New Country Added by' . auth()->user()->name);
        return redirect()->route('countries.index')->with('success', 'Country Added successfully');
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

    public function getStates(Request $request, CountryService $countryService)
    {
        $input = $request->all();
        $country_id = $input['country_id'];
        $states = $countryService->getStatesbyCountry($country_id);
        if ($input['state_id'] == "") {

            $data2 =  view('partials._states')
                ->with(compact('states'))
                ->render();
        } else {
            $state_id = $input['state_id'];

            $data2 =  view('partials._states')
                ->with(compact('states', 'state_id'))
                ->render();
        }
        return response()->json(['data' => $data2]);
    }

    public function edit(string $id, CountryService $countryService)
    {
        //
        $id = decrypt($id);

        $country = $countryService->getCountry($id);
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryPostRequest $request, string $id, CountryService $countryService)
    {

        $id = decrypt($id);
        $input = $request->all();

        $country = $countryService->getCountry($id);
        $countryService->updateCountry($country, $input);
        LogActivity::addToLog('Country ' . $input['name'] . ' updated by ' . auth()->user()->name);
        return redirect()->route('countries.index')->with('success', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CountryService $countryService)
    {
        //
        $id = decrypt($id);
        $country = $countryService->getCountry($id);
        $countryService->deleteCountry($country);
        LogActivity::addToLog('Country ' . $country->name . ' removed by ' . auth()->user()->name);
        return redirect()->route('countries.index')->with('success', 'Country Deleted successfully');
    }
}

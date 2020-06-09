<?php

namespace App\Http\Controllers;

use App\Forms\CarForm;
use App\Make;
use App\Rules\twoWords;
use App\Vehicle;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vehicles_year = Vehicle::distinct()->OrderBy('year')->get('year');
        $vehicles_owner = Vehicle::distinct()->OrderBy('owner')->get('owner');
        $thisYear = (int) date('Y');
        $makes = Make::all();

        $active = 0;
        if ($request->by == 'make_id') {
            if ($request->order == 'asc') {
                $vehicles = Vehicle::OrderBy('make_id')->get();
            } elseif ($request->order == 'desc') {
                $vehicles = Vehicle::OrderBy('make_id', 'desc')->get();
            }
        } elseif ($request->by == 'owner') {
            if ($request->order == 'asc') {
                $vehicles = Vehicle::OrderBy('owner')->get();
            } elseif ($request->order == 'desc') {
                $vehicles = Vehicle::OrderBy('owner', 'desc')->get();
            }
        } elseif ($request->by == 'year') {
            if ($request->order == 'asc') {
                $vehicles = Vehicle::OrderBy('year')->get();
            } elseif ($request->order == 'desc') {
                $vehicles = Vehicle::OrderBy('year', 'desc')->get();
            }
        }else {
            $vehicles = Vehicle::all();
            $active = 0;
        }
        if ($request->show_year) {
            $vehicles = Vehicle::where('year', $request->show_year)->get();
            $active = $request->show_year;
        }
        if ($request->show_prevOwners) {
            $vehicles = Vehicle::where('prevOwners', $request->show_prevOwners)->get();
            $active = 0;
        }
        if ($request->show_owner) {
            $vehicles = Vehicle::where('owner', $request->show_owner)->get();
            $active = 0;
            
        } 
        if ($request->show_make_id) {
            $vehicles = Vehicle::where('make_id', $request->show_make_id)->get();
            $active = 0;
            
        } 
        
        return view('vehicle.index', [
            'active' => $active,
            'vehicles' => $vehicles,
            'makes' => $makes,
            'thisYear' => $thisYear,
            'vehicles_owner' => $vehicles_owner,
            'vehicles_year' => $vehicles_year,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(CarForm::class, [
            'method' => 'POST',
            'url' => route('vehicle.store'),
        ]);

        return view('vehicle.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thisYear = (int) date('Y');

        $validator = Validator::make($request->all(),
            [
                'make_id' => ['required'],
                'year' => ['required', 'size:4'],
                'owner' => ['required', new twoWords, 'regex:/^[\pL\s]+$/'],
                // 'prevOwners' => [ 'max:2'],
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // $request->validate([
        // ]);

        $vehicle = new Vehicle();
        $vehicle->make_id = $request->make_id;

        $vehicle->year = $request->year;
        if ((int) $request->year < 1900) {
            return redirect()->back()->with('info_message', 'Vehicle cannot be older than of year 1900 ');
        } elseif ((int) $request->year > $thisYear) {
            return redirect()->back()->with('info_message', 'Vehicle cannot be newer than current year');
        }
        $vehicle->owner = $request->owner;
        $vehicle->prevOwners = $request->prevOwners;
        $vehicle->comments = $request->comments;
        if ($request->comments == null) {
            $vehicle->comments = 'n/a';
        }
        $vehicle->save();
        return redirect()->route('vehicle.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}

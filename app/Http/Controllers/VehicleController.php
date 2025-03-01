<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return inertia('Impound/Record', compact('vehicles'));
    }

    public function create()
    {
        return inertia('Impound/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
        }

        $image = $this->saveImage($file);


        $data['image'] = $image;

        Vehicle::create($data);
    }


    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    public function updateStatus(string $id, string $status)
    {
        $validStatus = ['suspended', 'released'];

        if (!in_array($status, $validStatus)) {
            return redirect()->back();
        }

        $vehicle = Vehicle::findOrFail($id);

        $vehicle->status = $status;

        $vehicle->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    private function saveImage(mixed $file): string
    {

        $fileName = now()->format('YmdHis') . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('files'), $fileName);

        return $fileName;
    }
}

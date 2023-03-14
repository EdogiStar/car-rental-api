<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Car;

class CarController extends Controller
{
    public function destroy($id)
    {
        Car::find($id)->delete();
        return Car::all();
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $car->update($request->all());
        return $car;
    }

    public function show($id)
    {
        return Car::find($id);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'car_name' => 'required|string',
            'status' => 'required|integer'
        ]);

        $car = Car::create([
            'car_name' => $fields['car_name'],
            'status' => $fields['status']
        ]);

        return response($car, 201);
    }

    public function index()
    {
        return Car::all();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $state = State::all();
        if ($request->ajax()) {
            $data = City::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCity">Edit</a> &nbsp;';
                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCity">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('city.crud', ['states' => $state]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|alpha|max:30'
        ]);
        City::updateOrCreate(
            [
                'id' => $request->city_id
            ],
            [
                'state_id' => $request->state_id,
                'city' => $request->city,
            ]
        );
        return response()->json(['success' => 'City saved successfully.']);
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return response()->json($city);
    }

    public function destroy($id)
    {
        $state = City::findOrFail($id);
        $state->delete();
        return response()->json(['success' => 'City deleted successfully.']);
    }
}

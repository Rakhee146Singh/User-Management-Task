<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index()
    {
        $city = City::all();
        return view('city/list', ['cities' => $city]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = City::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="/city/edit/' . $row->id . '"class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
        // $state = State::findOrFail($request->state)->get();
        // dd($state);
        $request->validate([
            'city' => 'required|max:30'
        ]);
        $data = $request->all();
        City::create([
            'state_id' => $data['state'],
            'city' => $data['city'],
        ]);
        return redirect('city')->with('success', ' Data Inserted Successfully');
    }

    public function save()
    {
        $state = State::all();
        return view('city/index', ['states' => $state]);
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('city/edit', ['cities' => $city]);
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $city->state_id = $request->state;
        $city->city = $request->city;
        $city->save();
        return redirect('city')->with('success', ' Data Updated Successfully');
    }

    public function destroy($id)
    {
        City::findOrFail($id)->delete();
        return redirect('city')->with('success', 'City Data Deleted Successfully');
    }
}

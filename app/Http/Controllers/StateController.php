<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index()
    {
        $state = State::all();
        return view('state/list', ['states' => $state]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $data = State::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="/state/edit/' . $row->id . '"class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'state' => 'required|max:30'
        ]);
        $data = $request->all();
        State::create([
            'country_id' => $data['country'],
            'state' => $data['state'],
        ]);
        return redirect('state')->with('success', ' Data Inserted Successfully');
    }

    public function save()
    {
        $country = Country::all();
        return view('state/index', ['countries' => $country]);
    }

    public function edit($id)
    {
        $state = State::find($id);
        return view('state/edit', ['states' => $state]);
    }

    public function update(Request $request, $id)
    {
        $state = State::find($id);
        $state->country_id = $request->country;
        $state->state = $request->state;
        $state->save();
        return redirect('state')->with('success', ' Data Updated Successfully');
    }

    public function destroy($id)
    {
        $data = State::findOrFail($id);
        $data->delete();
        return redirect('state')->with('success', 'State Data Deleted Successfully');
    }
}

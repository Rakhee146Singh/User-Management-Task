<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $country = Country::all();
        // $data = State::with('country');
        // // $data = State::all();
        // dd($data);
        if ($request->ajax()) {
            // $country = Country::select('country')->get();
            $data = State::where(['country_id' => $request->country])->get();
            // $data = State::all();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('country', function (State $data) {
                //     return $data->countries->country;
                // })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editState">Edit</a> &nbsp;';
                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteState">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('state.crud', ['countries' => $country]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'state' => 'required|alpha|max:30'
        ]);
        State::updateOrCreate(
            [
                'id' => $request->state_id
            ],
            [
                'country_id' => $request->country_id,
                'state' => $request->state,
            ]
        );
        return response()->json(['success' => 'State saved successfully.']);
    }

    public function edit($id)
    {
        $state = State::findOrFail($id);
        return response()->json($state);
    }

    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        return response()->json(['success' => 'State deleted successfully.']);
    }
}

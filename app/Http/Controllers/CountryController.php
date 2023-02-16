<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Country::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCountry">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCountry">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('country.crud');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|alpha|max:30'
        ]);
        Country::updateOrCreate(
            [
                'id' => $request->country_id
            ],
            [
                'country' => $request->country,
            ]
        );
        return response()->json(['success' => 'Country saved successfully.']);
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return response()->json($country);
    }

    public function destroy($id)
    {
        $data = Country::findOrFail($id);
        $data->delete();
        return response()->json(['success' => 'Country deleted successfully.']);
    }
}

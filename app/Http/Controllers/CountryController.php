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
        return view('country.list');
    }

    // public function store(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Country::all();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
    //                 $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    //                 return $btn;
    //             })
    //             // ->addColumn('action', function ($row) {
    //             //     return '<a href="/country/edit/' . $row->id . '"class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>';
    //             // })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function store(Request $request)
    {
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
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'country' => 'required|max:30'
    //     ]);
    //     $data = $request->all();
    //     Country::create([
    //         'country' => $data['country'],
    //     ]);
    //     // return redirect('country')->with('success', 'Inserted Data Successfully.');
    //     return response()->json(['success' => 'Product saved successfully.']);
    // }

    // public function save()
    // {
    //     return view('country/index');
    // }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        // return view('country/edit', ['countries' => $country]);
        return response()->json($country);
    }

    // public function update(Request $request, $id)
    // {
    //     $country = Country::findOrFail($id);
    //     $country->country = $request->country;
    //     $country->save();
    //     return redirect('country')->with('success', 'Country Data Updated');
    // }

    public function destroy($id)
    {
        $data = Country::findOrFail($id);
        $data->delete();
        // return redirect('country')->with('success', 'Country Data Deleted Successfully');
        return response()->json(['success' => 'Product deleted successfully.']);
    }

    // public function index()
    // {
    //     if (request()->ajax()) {
    //         return datatables()->of(Country::select('*'))
    //             ->addColumn('action', function ($row) {
    //                 return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $id }})" data-original-title="Edit"
    //                 class="edit btn btn-success edit">
    //                 Edit
    //             </a>&nbsp;<a href="javascript:void(0)" id="delete-country" onClick="deleteFunc({{ $id }})" data-toggle="tooltip"
    //             data-original-title="Delete" class="delete btn btn-danger">
    //             Delete
    //         </a>';
    //             })
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }
    //     return view('country.list');
    // }

    // public function store(Request $request)
    // {
    //     $countryId = $request->id;
    //     $country   =   Country::updateOrCreate(
    //         [
    //             'id' => $countryId
    //         ],
    //         [
    //             'country' => $request->country,
    //         ]
    //     );
    //     return Response()->json($country);
    // }

    // public function edit(Request $request)
    // {
    //     $where = array('id' => $request->id);
    //     $country  = Country::where($where)->first();
    //     return Response()->json($country);
    // }

    // public function destroy(Request $request)
    // {
    //     $country = Country::where('id', $request->id)->delete();
    //     return Response()->json($country);
    // }
}

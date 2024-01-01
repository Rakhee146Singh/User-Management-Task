<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('employee');
    }

    public function fetch_all(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('roles', '=', 'employee')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="/employee/edit/' . $row->id . '"class="btn btn-primary btn-sm">Edit</a>&nbsp;
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('edit_employee', compact('data'));
    }

    public function edit_validation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $data = $request->all();
        $form_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
        );
        User::whereId($data['hidden_id'])->update($form_data);
        return redirect('employee')->with('success', 'Employee Data Updated');
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect('employee')->with('success', 'Employee Data Deleted Successfully');
    }

    public function records(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));
                if ($end_date->greaterThan($start_date)) {
                    $users = User::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $users = User::latest()->get();
                }
            } else {
                $users = User::latest()->get();
            }
            return response()->json([
                'users' => $users
            ]);
        } else {
            abort(403);
        }
    }
    // public function destroy($id)
    // {
    //     $data = User::find($id);
    //     $image_path = public_path() . '/' . $data->filename;
    //     unlink($image_path);
    //     $data->delete();
    //     // if(Storage::delete($data->filename)) {
    //     //     $data->delete();
    //     //  }
    //     return redirect('employee');
    // }
}

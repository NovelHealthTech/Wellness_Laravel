<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class Zonemaster extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('admin.zonemaster.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::all();

        return view('admin.zonemaster.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {


            $validated = $request->validate([
                "image" => "required",
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required|email|unique:users,email",
                "mobile" => "required",
                "role_id" => "required",
            ]);
            $file = $request->image;
            $filename = $file->getClientOriginalName();

            if (!Storage::disk('local')->exists('uploads/' . $filename)) {
                $path = $file->storeAs('uploads', $filename, 'local');

            } else {
                $path = 'uploads/' . $filename;
            }

            $validated["image"] = $path;


            $user = User::create($validated);

            return redirect()->route('admin.zonemaster.index')->with(["success" => "Zone Manage added Successfully"]);

        } catch (ValidationException $e) {


            return back()->withErrors($e->errors())->withInput();

        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function fetchmanagers(Request $request)
    {

        try {


            if ($request->ajax()) {
                $data = Package::select('id', 'name', 'vendor_price', 'package_company_id', 'is_active');

                return DataTables::of($data)
                    ->addColumn('status', function ($row) {
                        return $row->is_active == 1
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>';
                    })
                    ->addColumn('action', function ($row) {
                        return '<a href="' . route('admin.package.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    })
                    ->rawColumns(['status', 'action']) // ✅ include status, not is_active
                    ->make(true);
            }



        } catch (Exception $e) {




        }



    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validate = $request->validate([
                "name" => "required",
                "status" => "required",
            ]);


            Vendor::create($validate);


            return redirect()->route('admin.vendor.index')->with(["success" => "Vedor Added Successfully"]);


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
        try {

            $vendor = Vendor::findorFail($id);

            if ($vendor) {
                return view('admin.vendor.edit', compact('vendor'));
            }

        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $vendor = Vendor::findOrFail($id);

            $vendor->update([
                "name" => $request->name,
                "status" => $request->status,
            ]);

            return redirect()->route("admin.vendor.index",compact('vendor'))->with(["success"=>"Vendor Upadted Successfully"]);

        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchvendor(Request $request)
    {

        $data = Vendor::all();

        return DataTables::of($data)
            ->addIndexColumn() // For Serial Number
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.vendor.edit', $row->id) . '" class="btn btn-success btn-sm">Edit</a>';
            })
            ->rawColumns(['status', 'action']) // Include status here so HTML renders
            ->editColumn('created_at', function ($row) {
                return $row->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A');
            })
            ->make(true);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Type\TrueType;
use Yajra\DataTables\Facades\DataTables;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.coupon.index");
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


            Coupon::create($validate);

            return back()->with(["success" => "Coupon added successfully"]);


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

            $coupon = Coupon::findorFail($id);

            return view('admin.coupon.edit', compact('coupon'));

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

            $coupon = Coupon::findorFail($id);

            $coupon->update([

                "name" => $request->name,
                "status" => $request->status,

            ]);

            return redirect()->route('admin.coupon.index')->with(["success" => "Coupon Added Successfully"]);

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

    public function fetchcoupons(Request $request)
    {

        try {

            $data = Coupon::select("id", "name", "status", "created_at", "updated_at");


            return DataTables::of($data)
                ->addColumn("status", function ($row) {

                    if ($row->status == 1) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }


                })
                ->addColumn("action", function ($row) {

                    return ' <a href="' . route('admin.coupon.edit', $row->id) . '" class="btn btn-sm btn-warning">
                <i class="mdi mdi-pencil"></i> Edit
            </a>
            <a href="' . route('admin.package.destroy', $row->id) . '" 
               class="btn btn-sm btn-danger delete-btn" 
               onclick="return confirm(\'Are you sure you want to delete this package?\')">
                <i class="mdi mdi-delete"></i> Delete
            </a>';


                })
                ->editColumn('created_at', function ($row) {
                    // Convert to Indian time format: dd-mm-yyyy hh:mm AM/PM
                    return \Carbon\Carbon::parse($row->created_at)
                        ->timezone('Asia/Kolkata')
                        ->format('d-m-Y h:i A');
                })
                ->editColumn('updated_at', function ($row) {
                    // Convert to Indian time format: dd-mm-yyyy hh:mm AM/PM
                    return \Carbon\Carbon::parse($row->updated_at)
                        ->timezone('Asia/Kolkata')
                        ->format('d-m-Y h:i A');
                })
                ->rawColumns(['action', 'status']) // allow HTML rendering
                ->make(true);


        } catch (Exception $e) {

            return back()->with(["error" => $e->getMessage()]);

        }



    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newpackage;
use App\Models\Package;
use App\Models\Vendor;
use App\Models\Vendorpricenht;
use Exception;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.package.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $vendors = Vendor::all();

        return view('admin.package.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validate = $request->validate([
                "packagename" => "required|string|max:255",
                "discount" => "nullable|numeric|min:0",
                "status" => "required|boolean",
                "description" => "nullable",
                "note" => "nullable|string|max:1000",
                "type" => "nullable|string|max:100",

            ]);

            $newpackage = Newpackage::create($validate);
            $vedorprice = $request->vendor_price;
            $nht_price = $request->nht_price;
            $packagecodes = $request->package_codes;

            foreach ($vedorprice as $key => $price) {

                Vendorpricenht::create([
                    "package_id" => $newpackage->id,
                    "vendor_id" => $key,
                    "package_code" => $packagecodes[$key] ?? null,
                    "vendor_price" => $price,
                    "nht_price" => $nht_price[$key] ?? null
                ]);
            }


            return redirect()->route('admin.package.index')->with(["status" => "success", "message" => "Package Added Successfully"]);



        } catch (ValidationException $e) {



            return response()->json([
                "status" => "failure",
                "errors" => $e->errors(),
            ]);


        } catch (Exception $e) {

            return response()->json([
                "status" => "failure",
                "message" => "Errro Occures",
                "errors" => $e->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            $package = Newpackage::findorFail($id);
            $vendors = Vendor::all();

            return view("admin.package.edit", compact('package', 'vendors'));

        } catch (Exception $e) {


            return back()->with(["error" => "Something Went Wrong...!!!!"]);


        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        try {

            $package = Newpackage::findorFail($id);

            $validate = $request->validate([
                "packagename" => "required|string|max:255",
                "price" => "required|numeric|min:0",
                "discount" => "nullable|numeric|min:0",
                // package_code unique except current id
                "package_code" => "required|string|max:100|unique:newpackages,package_code," . $id,

                "status" => "required|boolean",
                "vendor_id" => "required|exists:vendors,id",

                "description" => "nullable|string|max:1000",
                "note" => "nullable|string|max:1000",
                "type" => "nullable|string|max:100",
                "vendor_price" => "nullable|string|max:100",
            ]);

            if ($request->image) {
                $file = $request->file("image");
                $filepath = uploadFile($file, 'uploads');
                $validate["image"] = $filepath;

            } else {
                $path = $package->image;
                $validate["image"] = $path;
            }

            $package->update($validate);

            return response()->json([
                'status' => 'success',
                'redirect' => route('admin.package.index'),
                'message' => 'Package added successfully'
            ], 200);



        } catch (ValidationException $e) {


            return response()->json([

                "status" => "error",
                "errors" => $e->errors(),
            ]);
        } catch (Exception $e) {

            return response()->json([
                "status" => "error",
                "status"
            ]);


        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchallpackages(Request $request)
    {


        if ($request->ajax()) {

            $data = Newpackage::select('id', 'packagename', 'price', "vendor_id", "image", "status", "updated_at", "created_at");

            return DataTables::of($data)
                ->addColumn('status', function ($row) {

                    if ($row->status == 1) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }
                })

                ->addColumn('vendor_name', function ($row) {

                    return $row->vendor->name;


                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return '<img src="' . Storage::url($row->image) . '" alt="Image" style="width:200px!important; height:108px!important;border-radius:0%;object-fit:cover" />';
                    }
                    return '<span class="text-muted">No image</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
            <a href="' . route('admin.package.edit', $row->id) . '" class="btn btn-sm btn-warning">
                <i class="mdi mdi-pencil"></i> Edit
            </a>
            <a href="' . route('admin.package.destroy', $row->id) . '" 
               class="btn btn-sm btn-danger delete-btn" 
               onclick="return confirm(\'Are you sure you want to delete this package?\')">
                <i class="mdi mdi-delete"></i> Delete
            </a>
        ';
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
                ->rawColumns(['action', 'status', 'image', '<vendor_></vendor_>name']) // allow HTML rendering
                ->make(true);
        }



    }
}

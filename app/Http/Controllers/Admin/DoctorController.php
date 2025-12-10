<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bankdetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.doctor.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            $validate = $request->validate([
                'image' => 'required|nullable|image|mimes:jpg,jpeg,png|max:2048',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role_id' => 'required|exists:roles,id',
                'mobile' => 'required|digits:10',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'pincode' => 'required|digits:6',
                'degree' => 'required|nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'pancardno' => 'required|string|max:20',
                'aadharcardno' => 'required|digits:12',
                'aadhaarcardpdf' => 'required|nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'pancardpdf' => 'required|nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'agreementpdf' => 'required|nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'agreementexpirydate' => 'required|nullable|date',
                'registartioncertificatepdf' => 'required|nullable|mimes:jpg,jpeg,png,pdf|max:2048',
                'beneficiary_name' => 'required|string|max:255',
                'branch_name' => 'required|string|max:255',
                'account_no' => 'required|string|max:50',
                'ifsc_code' => 'required|string|max:20',
                'cancelcheckpdf' => 'required|  nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            //for the bank credentials
            $bank_credentials = [
                'beneficiary_name' => $validate['beneficiary_name'],
                'branch_name' => $validate['branch_name'],
                'account_no' => $validate['account_no'],
                'ifsc_code' => $validate['ifsc_code'],
                'cancelcheckpdf' => $validate['cancelcheckpdf'],
            ];



            // File uploads using helper
            $validate['image'] = uploadFile($request->file('image'), 'uploads');
            $validate['degree'] = uploadFile($request->file('degree'), 'uploads');
            $validate['aadhaarcardpdf'] = uploadFile($request->file('aadhaarcardpdf'), 'uploads');
            $validate['pancardpdf'] = uploadFile($request->file('pancardpdf'), 'uploads');
            $validate['agreementpdf'] = uploadFile($request->file('agreementpdf'), 'uploads');
            $validate['registartioncertificatepdf'] = uploadFile($request->file('registartioncertificatepdf'), 'uploads');
            $validate['cancelcheckpdf'] = uploadFile($request->file('cancelcheckpdf'), 'uploads');


            // Save to database
            $bank = Bankdetails::create($bank_credentials);
            $bank_id = $bank->id;


            $validate["bank_id"] = $bank_id;

            User::create($validate);

            return response()->json([
                'status' => 'success',
                'message' => "Doctor added successfully",
                'redirect_url' => route('admin.doctor.index'),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
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
}

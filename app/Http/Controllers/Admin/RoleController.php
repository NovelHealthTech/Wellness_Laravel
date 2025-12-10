<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.role.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                "name" => "required",
            ]);


            Role::create([
                "name" => $request->name,
                "guard_name" => 'web',
            ]);



            return redirect()->route("admin.role.index")->with(["success" => "Role added successfully"]);

        } catch (ValidationException $e) {

            return back()->with($e->errors())->withInput();

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
        try
        {

          $role=Role::findorFail($id);

          return view('admin.role.edit',compact('role'));
  
        }catch(Exception $e){


            return back()->with(["error"=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        
      try{
         
        Role::where("id",$id)->update([
            "name"=>$request->name,
        ]);

        
        return redirect()->route('admin.role.index')->with(["success"=>"Role updated Successfullly...!!"]);
    

      }catch(Exception $e){



      }
 




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       

       try{
        
            $role=Role::findorFail($id);

            if($role){
                  $role->delete();

                  return  response()->json([
                    "status"=>"success",
                    "message"=>"Role Delete Succeessfully"
                  ]);


            }

       }catch(Exception $e){

        return response()->json([
            
            "status"=>"failure",
            "message"=>$e->getMessage(),
        ]);


       }

    }

    public function fetchRoles(Request $request)
    {
        if ($request->ajax()) {

            $data = Role::select('id', 'name', 'created_at', 'updated_at');

            return DataTables::of($data)

                ->addColumn('action', function ($row) {

                    return '
                    <a href="'.route('admin.role.edit',$row->id).'" class="btn btn-sm btn-warning">Edit</a>
                    <a href="'.route('admin.role.destroy',$row->id).'" class="btn btn-sm btn-danger deleteRole">Delete</a>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
 
    }
}

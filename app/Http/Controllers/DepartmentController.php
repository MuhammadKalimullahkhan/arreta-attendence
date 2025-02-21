<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentController extends Controller
{
    function createTR($department){
        return "<tr id=\"department-{$department->id}\">
                    <td>{$department->description}</td>
                    <td>" . \Carbon\Carbon::parse($department->created_at)->format('d-m-Y') . "</td>
                    <td>" . \Carbon\Carbon::parse($department->updated_at)->format('d-m-Y') . "</td>
                    <td>
                                            <div class=\"dropdown\">
                                                <button class=\"btn btn-primary dropdown-toggle\" type=\"button\"
                                                    data-bs-toggle=\"dropdown\">Actions</button>
                                                <ul class=\"dropdown-menu\">
                                                    <li>
                                                        <button class=\"dropdown-item text-success\"
                                                            onclick=\"editDepartment($department->id, '$department->description')\">
                                                            <ion-icon name=\"create-outline\"></ion-icon> Edit
                                                        </button>

                                                    </li>
                                                    <li>
                                                        <button class=\"dropdown-item text-danger\"
                                                            hx-delete=\"/departments/$department->id/\"
                                                            hx-target=\"closest tr\"
                                                            hx-on::confirm=\"return confirmAlert(event);\"
                                                            hx-on::after-request=\"successAlert('Deleted', 'Department has been deleted.')\">Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                </tr>";
    }

    function list(){
        $departments=Department::get();
        return view('departments', ['departments'=>$departments]);
        
    }

    public function create(Request $request){
        $request->validate([
            'description' => 'required|string|max:255',
        ]);
    
        $department = Department::create([
            'description' => $request->description,
            'CompanyID' => 1, // Change this based on actual input
            'EntryUserID' => auth()->id() ?? 1, // Get authenticated user or default
            'EntryDate' => now(),
            'IsActive' => 1,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'department created successfully.',
            'html' => $this->createTR($department)
        ]);
    }
    
    function edit(Request $request, $id){
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'description' => $request->description,
        ]);

        // return response()->json(['success'=>true,'message' => 'Department updated successfully', 'department' => $department]);
        return response()->json([
            'success' => true,
            'message' => 'department updated successfully.',
            'id' => $department->id,
            'html' => $this->createTR($department)
        ]);
    }

    public function delete($id){
        $department = Department::findOrFail($id);
        $department->delete();

        return response('', 200);
    }

}

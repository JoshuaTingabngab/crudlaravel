<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $students = Student::where(function ($query) use ($search) {
            return $query->where("id_number", "LIKE", "%$search%")
                ->orWhere("first_name", "LIKE", "%$search%")
                ->orWhere("last_name", "LIKE", "%$search%")
                ->orWhere("middle_name", "LIKE", "%$search%")
                ->orWhere("address", "LIKE", "%$search%");
        })->get();
        return view("students.index", compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'id_number' => 'required|unique:students,id_number', 
        'first_name' => 'required|string',
        'middle_name' => 'required|string',
        'last_name' => 'required|string',
        'name_extension' => 'nullable|string', 
        'course' => 'required|string',
        'sex' => ['required', Rule::in(['Male', 'Female'])], 
        'address' => 'required|string',
        'contact_number' => 'required|string',
        'birthdate' => 'required|date',
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'is_active' => 'required|boolean',
        ]);

        $student = new Student();
        $student->id_number = $request->id_number;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->name_extension = $request->name_extension;
        $student->course = $request->course;
        $student->sex = $request->sex;
        $student->address = $request->address;
        $student->contact_number = $request->contact_number;
        $student->birthdate = $request->birthdate;
        $student->is_active = $request->is_active;
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/students/', $filename);
            $student->profile_image = $filename;
        }
        $student->save();
        return back()->with('status', 'Successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view("students.edit", compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'birthdate' => 'required',
        ]);

        // Update other student details
        $student->id_number = $request->id_number;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->middle_name = $request->middle_name;
        $student->name_extension = $request->name_extension;
        $student->course = $request->course;
        $student->sex = $request->sex;
        $student->address = $request->address;
        $student->contact_number = $request->contact_number;
        $student->birthdate = $request->birthdate;
        $student->is_active = $request->is_active;
       
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            $oldImagePath = public_path('uploads/students/' . $student->profile_image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload new profile image
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/students/'), $imageName);
            $student->profile_image = $imageName;
        }

        $student->save();

        return back()->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->is_active = 0;
        $student->save();

        return back()->with("status", "Successfully deleted!");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\StudentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentUser::paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function newAdmissionForm()
    {
        return view('admin.students.new-admission');
    }

    public function checkStudent(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:11',
        ]);

        $student = StudentUser::where('phone', $request->phone)->first();

        if ($student) {
            return redirect()->route('students.show', $student->id);
        }

        return redirect()->route('students.register')->with('phone', $request->phone);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = StudentUser::create([
            'full_name' => $request->full_name,
            'nick_name' => $request->nick_name,
            'phone' => $request->phone,
            'registration_number' => StudentUser::generateRegistrationNumber(),
            'password' => Hash::make(StudentUser::generatePassword()),
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'father_mobile' => $request->father_mobile,
            'mother_mobile' => $request->mother_mobile,
            'is_verified' => true,
        ]);

        return redirect()->route('students.index')->with('success', 'Student registered successfully with Reg No: '.$student->registration_number);
    }

    public function show(StudentUser $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(StudentUser $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, StudentUser $student)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nick_name' => 'required|string|max:255',
            'phone' => 'required|string|digits:11|unique:student_users,phone,'.$student->id,
            'gender' => 'nullable|in:male,female,other',
            'religion' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'father_mobile' => 'nullable|string|digits:11',
            'mother_mobile' => 'nullable|string|digits:11',
        ]);

        $student->update([
            'full_name' => $request->full_name,
            'nick_name' => $request->nick_name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'father_mobile' => $request->father_mobile,
            'mother_mobile' => $request->mother_mobile,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(StudentUser $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}

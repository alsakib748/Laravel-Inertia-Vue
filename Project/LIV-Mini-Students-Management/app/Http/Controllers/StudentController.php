<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{

    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        return inertia('Students/Index', [
            'students' => $students,
        ]);
    }

    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        // $sections = SectionResource::collection(Section::all());

        return inertia('Students/Create', [
            'classes' => $classes,
            // 'sections' => $sections,
        ]);
    }

    // todo Student $student : Calls It Root model Bindning
    public function store(StoreStudentRequest $request)
    {

        Student::create($request->validated());

        return redirect()->route('students.index');

    }

    public function edit(Student $student)
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Edit', [
            'classes' => $classes,
            'student' => StudentResource::make($student),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()->route('students.index');
    }

    // todo Student $student : Calls It Root model Bindning
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }

}

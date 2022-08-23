<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('subjects')->latest()->get();
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('students.create',compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|max:2048',
            'subject' => 'required',
            'score' => 'required',
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
        $path = 'images';
        $request->image->move(public_path($path), $imageName);
        
        $request['image_path'] = $path.'/'.$imageName;
        Student::create($request->all());
        return response()->json(['success'=>'Student created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $subjects = Subject::all();
        return view('students.edit',compact('student','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {

          
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'score' => 'required',
        ]);
        $std = Student::where('id',$student['id'])->first();
        if($request->image){
            if($std){
                unlink($std->image_path);
            }
            $imageName = time().'.'.$request->image->extension();  
            $path = 'images';
            $request->image->move(public_path($path), $imageName);
            
            $request['image_path'] = $path.'/'.$imageName;
        }
        $student->update($request->all());
  
        return response()->json(['success'=>'Student updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        $student->delete();
        return response()->json(['success'=>'Student deleted successfully!']);
    }
}

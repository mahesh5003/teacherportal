<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index()
{
//return all student list
$students = Student::all();
return view('dashboard',['students' => $students]);
}

/**
* Store a newly created resource in storage.
*/
public function store(Request $request,  Student $student)
{   
$data = $request->all();
$is_exist=Student::where('name',$data['name'])->where('subject',$data['subject'])->first();
if(isset($is_exist) && !empty($is_exist)){
//if student and subject already exist updating only marks
$m['marks']=$data['marks'];
$is_exist->update($m);
return $is_exist;
}else{
//if student not exist adding new student
$student->fill($data);
$student->save();
return $student;
}


}

/**
* Show the form for editing the specified resource.
*/
public function edit(Request $request, Student $student)
{    
$studentData=Student::where('id',$request->id)->first(); 
return view('editstudent', ['student' => $studentData,]);
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request)
{  
$request->validate([
'name' => 'required',
'marks' => 'required|numeric',
'subject' => 'required',
]);

$data = $request->all();
$is_exist = Student::where('name',$data['name'])->where('subject',$data['subject'])->first();
if(isset($is_exist) && !empty($is_exist)){  
    $m['marks']=$data['marks'];
    $is_exist->update($m); 
return redirect()->route('dashboard')->with('status','Student data edited successfully.');
}else{   
$student = Student::find($data['id']);
$student->fill($data);
$student->save();
return redirect()->route('dashboard')->with('status','Student data edited successfully.');
}

}


/**
* Update the specified resource in storage inline.
*/
public function editInline(Request $request)
{  
$data = $request->all();
$is_exist = Student::where('name',$data['name'])->where('subject',$data['subject'])->first();
if(isset($is_exist) && !empty($is_exist)){  
    $m['marks']=$data['marks'];
    $is_exist->update($m);  
return 1;
}else{   
$student = Student::find($data['id']);
$student->fill($data);
$student->save();
return 1;
}
}

/**
* Remove the specified resource from storage.
*/
public function destroy(Request $request)
{   
Student::where('id', $request->id)->delete();
return redirect()->back()->with('delete','Student deleted successfully');
}

}

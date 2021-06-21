<?php

namespace App\Http\Controllers\Auth;

use App\Models\Student;
use App\Models\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function studentmain(Request $request)
    {
        $student = Student::orderby('id', 'DESC')->simplePaginate(3);
        return view('Teacher.teacher', compact('student'));
    }

    public function studentpagination(Request $request)
    {
        if ($request->ajax()) {
            $student = Student::orderby('id', 'DESC')->simplePaginate(3);
            return view('Teacher.studentpage', compact('student'))->render();
        }
    }
    public function addstudentresult(Request $request)
    {
        $validated = $request->validate([
            'english' => 'required',
            'gujarati' => 'required',
            'hindi' => 'required',
            'sanskrit' => 'required',
            'maths' => 'required',
            'average' => 'required',
            'percentage' => 'required',
        ]);

        $student = Student::find($request->sid);
        $result = new Result();
        $result->english = $request->input('english');
        $result->gujarati = $request->input('gujarati');
        $result->hindi = $request->input('hindi');
        $result->sanskrit = $request->input('sanskrit');
        $result->maths = $request->input('maths');
        $result->average = $request->input('average');
        $result->percentage = $request->input('percentage');
        $student->result()->save($result);

        return response()->json(['success' => "Successfully Marks has been Added."]);
    }

    public function resultmain(Request $request)
    {
        // $student = Student::join('results', 'students.id', '=', 'results.student_id')->get(['students.*', 'results.*']);
        // return view('Teacher.resultlist', compact('student'));

        $student = Student::join('results', 'students.id', '=', 'results.student_id')->select(['students.*', 'results.*'])->orderBy('results.student_id', 'DESC')->simplePaginate(3);
        return view('Teacher.resultlist', compact('student'));
    }

    public function resultpagination(Request $request)
    {
        if ($request->ajax()) {
            $student = Student::join('results', 'students.id', '=', 'results.student_id')->select(['students.*', 'results.*'])->orderBy('results.student_id', 'DESC')->simplePaginate(3);
            return view('Teacher.resultpage', compact('student'))->render();
        }
    }
}

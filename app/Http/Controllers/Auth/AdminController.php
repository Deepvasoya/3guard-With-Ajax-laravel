<?php

namespace App\Http\Controllers\Auth;

use App\Models\Subject;
use App\Models\Standard;
use App\Models\Student;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addnewsubject(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
        ]);

        $subject = new Subject();
        $subject->subject = $request->input('subject');
        $subject->save();
        return response()->json(['success' => "Successfully subject has been Added."]);
    }

    public function addnewstandard(Request $request)
    {
        $validated = $request->validate([
            'standard' => 'required',
        ]);

        $standard = new Standard();
        $standard->standard = $request->input('standard');
        $standard->save();
        return response()->json(['success' => "Successfully standard has been Added."]);
    }

    public function subjectmain(Request $request)
    {
        $subjects = Subject::orderby('id', 'DESC')->simplePaginate(3);
        return view('Admin.subjectlist', compact('subjects'));
    }

    public function subjectpagination(Request $request)
    {
        if ($request->ajax()) {
            $subjects = Subject::orderby('id', 'DESC')->simplePaginate(3);
            return view('Admin.subjectpage', compact('subjects'))->render();
        }
    }

    public function subjectedit($id)
    {
        $sub = Subject::find($id);
        return response()->json($sub);
    }

    public function subjectupdate(Request $request)
    {
        $subj = Subject::find($request->id);
        $subj->subject = $request->subject;
        $subj->save();
        return response()->json(['success' => "Successfully subject has been Update."]);
    }

    public function subjectdelete($id)
    {
        $subj = Subject::find($id);
        $subj->delete();
        return response()->json(['success' => 'Subject Hasbeen Deleted.']);
    }

    public function standardmain(Request $request)
    {
        $standards = Standard::orderby('id', 'DESC')->simplePaginate(3);
        return view('Admin.standardlist', compact('standards'));
    }

    public function standardpagination(Request $request)
    {
        if ($request->ajax()) {
            $standards = Standard::orderby('id', 'DESC')->simplePaginate(3);
            return view('Admin.standardpage', compact('standards'));
        }
    }

    public function standarddelete($id)
    {
        $stand = Standard::find($id);
        $stand->delete();
        return response()->json(['success' => 'Standard Hasbeen Deleted.']);
    }

    public function teachermain(Request $request)
    {
        $teacher = Teacher::orderby('id', 'DESC')->simplePaginate(3);
        return view('Admin.teacherlist', compact('teacher'));
    }

    public function teacherpagination(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            $search = str_replace(" ", "%", $search);
            $teacher = Teacher::where('id', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('subject', 'like', '%' . $search . '%')->orderby('id', 'DESC')->simplePaginate(3);
            return view('Admin.teacherpage', compact('teacher'));
        }
    }

    public function teacherdelete($id)
    {
        $teac = Teacher::find($id);
        $teac->delete();
        return response()->json(['success' => 'Standard Hasbeen Deleted.']);
    }


    public function mainstudent(Request $request)
    {
        $student = Student::orderby('id', 'DESC')->simplePaginate(3);
        return view('Admin.admin', compact('student'));
    }

    public function paginationstudent(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $student = Student::where('id', 'like', '%' . $query . '%')->orWhere('name', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . '%')->orWhere('enrollno', 'like', '%' . $query . '%')->orWhere('standard', 'like', '%' . $query . '%')->orderby('id', 'DESC')->simplePaginate(3);
            return view('Admin.studentpage', compact('student'))->render();
        }
    }

    public function studentdelete($id)
    {
        $stu = Student::find($id);
        $stu->delete();
        return response()->json(['success' => 'Student Hasbeen Deleted.']);
    }

    public function mainresult(Request $request)
    {
        // $student = Student::join('results', 'students.id', '=', 'results.student_id')->get(['students.*', 'results.*']);
        // return view('Teacher.resultlist', compact('student'));
        $standard = Standard::all();
        $student = Student::join('results', 'students.id', '=', 'results.student_id')->select(['students.*', 'results.*'])->orderBy('results.student_id', 'DESC')->simplePaginate(3);
        return view('Admin.resultlist', compact('student', 'standard'));
    }

    public function paginationresult(Request $request)
    {
        if ($request->ajax()) {
            // $key = $request->get('key');
            // $key = str_replace(" ", "%", $key);
            // $student = Student::join('results', 'students.id', '=', 'results.student_id')->where('students.id', 'like', '%' . $key . '%')->orWhere('students.name', 'like', '%' . $key . '%')->orWhere('students.email', 'like', '%' . $key . '%')->orWhere('students.enrollno', 'like', '%' . $key . '%')->orWhere('students.standard', 'like', '%' . $key . '%')->orWhere('results.english', 'like', '%' . $key . '%')->orWhere('results.gujarati', 'like', '%' . $key . '%')->orWhere('results.hindi', 'like', '%' . $key . '%')->orWhere('results.sanskrit', 'like', '%' . $key . '%')->orWhere('results.maths', 'like', '%' . $key . '%')->orWhere('results.average', 'like', '%' . $key . '%')->orWhere('results.percentage', 'like', '%' . $key . '%')->orderBy('results.student_id', 'DESC')->simplePaginate(3);
            // return view('Admin.resultpage', compact('student'))->render();
            $standard = $request->get('standard');
            $student = Student::join('results', 'students.id', '=', 'results.student_id')->where('students.standard', '=', $standard)->orderBy('results.student_id', 'DESC')->simplePaginate(3);
            return view('Admin.resultpage', compact('student'))->render();
        }
    }
}

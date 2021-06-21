<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function result(Request $request)
    {
        $result =  Result::where('id', '=', $request->id)->first();
        return response()->json($result);
    }
}

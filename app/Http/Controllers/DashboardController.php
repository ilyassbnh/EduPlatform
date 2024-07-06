<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Module;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        //$user = Auth::user();
        $user = User::find(Auth::user()->id);

        if ($user && $user->hasRole('student')) {
            return view('student.indexx');
        } elseif ($user && $user->hasRole('teacher')) {
            // Fetch courses and modules associated with the teacher
            $teacherId = $user->id;
            $courses = Course::where('teacher_id', $teacherId)->get();
            $modules = Module::whereIn('course_id', $courses->pluck('id'))->get();

            return view('teacher.modules.index', compact('courses', 'modules'));
        } elseif ($user->hasRole('admin')) {
            $courses = Course::all();
            return view('admin.index', compact('courses'));
        }

        // Optionally handle the case where the user has no recognized role
        return redirect('/')->with('error', 'Role not recognized.');
    }
}

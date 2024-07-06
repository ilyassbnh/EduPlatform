<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Course;

class ModuleController extends Controller
{
    public function index()
    {
        $teacherId = Auth::user()->id;
        $courses = Course::where('teacher_id', $teacherId)->pluck('id');
        $modules = Module::whereIn('course_id', $courses)->paginate(3);
        return view('teacher.modules.index', compact('modules'));
    }

    public function create()
    {
        $courses = Course::where('teacher_id', Auth::user()->id)->get();
        return view('teacher.modules.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        Module::create($request->all());

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    public function edit($id)
    {
        $module = Module::findOrFail($id);
        $courses = Course::where('teacher_id', Auth::user()->id)->get();
        return view('teacher.modules.edit', compact('module', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        $module = Module::findOrFail($id);
        $module->update($request->all());

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
    // ModuleController.php
public function showModules(Course $course)
{
    $modules = $course->modules;

    return view('student.modules', compact('course', 'modules'));
}

}

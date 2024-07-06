<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = User::whereRoleIs('teacher')->get();
        return view('admin.create', compact('categories', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'image' => 'nullable|string', 
        ]);
    
        Course::create($validated);
    
        return redirect()->route('admin.index')->with('success', 'Course created successfully.');
    }
    

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        $teachers = User::whereRoleIs('teacher')->get();
        return view('admin.edit', compact('course', 'categories', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:users,id',
            'image' => 'nullable|string', // Validate the image path as a string (URL)
        ]);
    
        $course->update($validated);
    
        return redirect()->route('admin.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.index')->with('success', 'Course deleted successfully.');
    }
}

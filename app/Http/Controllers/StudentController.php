<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\demande as CourseRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;




class StudentController extends Controller
{
    // Method to show all courses for students
    public function studentIndex(Request $request)
    {
        $query = Course::with('teacher', 'modules.lessons');

        if ($request->has('search')) {
            $query->where('title', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->has('category') && $request->input('category') != '') {
            $query->where('category_id', $request->input('category'));
        }

        $courses = $query->get();
        $categories = Category::all();

        return view('student.courses', compact('courses', 'categories'));
    }

    // Method to show course details
    public function show($id)
    {
        $course = Course::with('teacher', 'modules.lessons')->findOrFail($id);
        return view('student.details', compact('course'));
    }

    // Method to handle course enrollment
    public function enroll(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $user = $request->user();

        // Insert course ID and user ID into the requests table
        CourseRequest::create([
            'course_id' => $course->id,
            'student_id' => $user->id,
            'status' => 'nv',
        ]);

        // Redirect to course details page after enrollment
        return redirect()->route('student.courses.show', $course->id)->with('success', 'You have successfully enrolled in the course!');
    }

    public function myCourses()
    {
        $user = Auth::user();
        $validCourses = CourseRequest::where('student_id', $user->id)->where('status', 'v')->with('course')->get();
        $notValidCourses = CourseRequest::where('student_id', $user->id)->where('status', 'nv')->with('course')->get();

        return view('student.my-courses', compact('validCourses', 'notValidCourses'));
    }
    
    
}


<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\demande as CourseRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = CourseRequest::with('course', 'student')->get();
        return view('admin.requests.index', compact('requests'));
    }

    public function create()
    {
        // Return a view to create a new request
        return view('admin.requests.create');
    }

    public function store(Request $request)
    {
        // Handle the store logic
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:users,id',
            'status' => 'required|in:v,nv',
        ]);

        CourseRequest::create($request->all());
        return redirect()->route('admin.requests.index')->with('success', 'Request created successfully');
    }

    public function show($id)
    {
        $request = CourseRequest::with('course', 'student')->findOrFail($id);
        return view('admin.requests.show', compact('request'));
    }

    public function edit($id)
    {
        $request = CourseRequest::findOrFail($id);
        return view('admin.requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:v,nv',
        ]);

        $courseRequest = CourseRequest::findOrFail($id);
        $courseRequest->update($request->all());
        return redirect()->route('admin.requests.index')->with('success', 'Request updated successfully');
    }

    public function destroy($id)
    {
        $request = CourseRequest::findOrFail($id);
        $request->delete();
        return redirect()->route('admin.requests.index')->with('success', 'Request deleted successfully');
    }
}


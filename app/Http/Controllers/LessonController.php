<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Module;

class LessonController extends Controller
{
    public function index($moduleId)
    {
        $module = Module::findOrFail($moduleId);
        $lessons = Lesson::where('module_id', $moduleId)->get();
        return view('teacher.lessons.index', compact('lessons', 'module'));
    }

    public function create($moduleId)
    {
        $module = Module::findOrFail($moduleId);
        return view('teacher.lessons.create', compact('module'));
    }

    public function store(Request $request, $moduleId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string',
        ]);

        $module = Module::findOrFail($moduleId);
        $lesson = new Lesson($request->all());
        $lesson->module_id = $module->id;
        $lesson->save();

        return redirect()->route('lessons.index', $moduleId)->with('success', 'Lesson created successfully.');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('teacher.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string',
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());

        return redirect()->route('lessons.index', $lesson->module_id)->with('success', 'Lesson updated successfully.');
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lessons.index', $lesson->module_id)->with('success', 'Lesson deleted successfully.');
    }

//     // LessonController.php
// public function showLessons(Module $module)
// {
//     $lessons = $module->lessons;

//     return view('student.lessons', compact('module', 'lessons'));
// }
// // LessonController.php
// public function showLesson(Lesson $lesson)
// {
//     return view('student.lesson', compact('lesson'));
// }
public function show($id)
{
    $lesson = Lesson::findOrFail($id);
    return view('student.lesson', compact('lesson'));
}

}


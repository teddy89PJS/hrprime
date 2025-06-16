<?php

namespace App\Http\Controllers\learning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
  public function index()
  {
    $courses = Course::all();
    return view('content.learning.trainings', compact('courses'));
  }
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'code' => 'required|string|max:50|unique:courses,code',
      'type' => 'required|string',
      'duration' => 'required|string',
      'date' => 'required|string',
    ]);

    $course = Course::create($validated);

    return response()->json([
      'message' => 'Course added successfully!',
      'course' => $course
    ]);
  }
  public function update(Request $request, $id)
  {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'code' => 'required|string|max:100',
      'type' => 'required|string',
      'duration' => 'required|string',
      'date' => 'required|string',
      'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,mp4,mov,avi|max:51200',
    ]);

    $course->fill($validated);

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $filename = time() . '_' . $file->getClientOriginalName();

      // Save the file to storage/app/public/courses
      $file->storeAs('courses', $filename, 'public');

      // Save the relative path (accessible via /storage/courses/filename)
      $course->file = 'courses/' . $filename;
    }


    $course->save();

    return response()->json(['message' => 'Course updated successfully.']);
  }
  public function updateCourse(Request $request)
  {
    $validated = $request->validate([
      'id' => 'required|exists:courses,id',
      'title' => 'required|string|max:255',
      'code' => 'required|string|max:100',
      'type' => 'required|string',
      'duration' => 'required|string',
      'date' => 'required|string',
      'file' => 'nullable|mimes:mp4,pdf,doc,docx,ppt,pptx|max:20480' // 20MB max
    ]);

    $course = Course::findOrFail($validated['id']);
    $course->title = $validated['title'];
    $course->code = $validated['code'];
    $course->type = $validated['type'];
    $course->duration = $validated['duration'];
    $course->date = $validated['date'];

    if ($request->hasFile('file')) {
      $filename = time() . '_' . $request->file('file')->getClientOriginalName();
      $path = $request->file('file')->storeAs('course_files', $filename, 'public');
      $course->file_path = $path;
    }

    $course->save();

    return response()->json(['message' => 'Course updated successfully.']);
  }
}

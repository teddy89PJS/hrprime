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

  public function update(Request $request, Course $course)
  {
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
      $file->storeAs('courses', $filename, 'public');
      $course->file = 'courses/' . $filename;
    }

    $course->save();

    return response()->json(['message' => 'Course updated successfully.']);
  }
}

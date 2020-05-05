<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\Course as CourseResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class CourseApiV2 extends Controller
{
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    public function show($id)
    {
        return new CourseResource(Course::findOrFail($id));
    }
}
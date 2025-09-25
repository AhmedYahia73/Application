<?php

namespace App\Http\Controllers\Api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Mail\ApplicationMail;
use Illuminate\Support\Facades\Mail;

use App\Models\Application;

use App\Models\City;
use App\Models\Job;
use App\Models\Qualification;

class ApplicationController extends Controller
{
    public function __construct(){}

    public function lists(Request $request){
        $cities = City::
        select('id', 'name', 'status')
        ->get();
        $jobs = Job::
        select('id', 'name', 'status')
        ->get();
        $qualifications = Qualification::
        select('id', 'name', 'status')
        ->get();

        return response()->json([
            'cities' => $cities,
            'jobs' => $jobs,
            'qualifications' => $qualifications,
        ]);
    }
 

    public function send_email(Request $request){
        $validator = Validator::make($request->all(), [
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'job_id' => ['required', 'exists:jobs,id'],
            'city_id' => ['required', 'exists:cities,id'], 
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'graduate_date' => ['required', 'date'],
            'address' => ['required'],
            'phone' => ['required'],
            'experiences' => ['required'],
            'current_job' => ['sometimes'],
            'courses' => ['sometimes'],
            'expected_salary' => ['required', 'numeric'],
            'university' => ['sometimes'],
            'collage' => ['sometimes'],
            'marital' => ['required', 'in:single,married,separated'],
            'children' => ['required_if:married,separated,', 'numeric'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $application = Application::create([
            'qualification_id' => $request->qualification_id ?? null,
            'job_id' => $request->job_id ?? null,
            'city_id' => $request->city_id ?? null,
            'name' => $request->name ?? null,
            'birth_date' => $request->birth_date ?? null,
            'graduate_date' => $request->graduate_date ?? null,
            'address' => $request->address ?? null,
            'phone' => $request->phone ?? null,
            'experiences' => $request->experiences ?? null,
            'current_job' => $request->current_job ?? null,
            'courses' => $request->courses ?? null,
            'expected_salary' => $request->expected_salary ?? null,
            'university' => $request->university ?? null,
            'collage' => $request->collage ?? null,
            'marital' => $request->marital ?? null,
            'children' => $request->children ?? null,
        ]);
        $application = Application::
        with('job', 'qualification', 'city')
        ->where('id', $application->id) 
        ->first();
        $application = [
            'id' => $application->id,
            'name' => $application->name,
            'birth_date' => $application->birth_date,
            'graduate_date' => $application->graduate_date,
            'address' => $application->address,
            'phone' => $application->phone,
            'experiences' => $application->experiences,
            'current_job' => $application->current_job,
            'courses' => $application->courses,
            'expected_salary' => $application->expected_salary,
            'university' => $application->university,
            'collage' => $application->collage,
            'marital' => $application->marital,
            'children' => $application->children, 
            'job' => $application?->job?->name, 
            'qualification' => $application?->qualification?->name, 
            'city' => $application?->city?->name, 
        ];
        Mail::to('ahmedahmadahmid73@gmail.com')->send(new ApplicationMail($application));

        return response()->json([
            'success' => 'You send email success'
        ]);
    }
}

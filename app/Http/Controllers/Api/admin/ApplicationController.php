<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Application;

class ApplicationController extends Controller
{
    public function view(Request $request){
        $applications = Application::
        with('qualification', 'job', 'city')
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'birth_date' => $item->birth_date,
                'graduate_date' => $item->graduate_date,
                'address' => $item->address,
                'phone' => $item->phone,
                'experiences' => $item->experiences,
                'current_job' => $item->current_job,
                'courses' => $item->courses,
                'expected_salary' => $item->expected_salary,
                'university' => $item->university,
                'collage' => $item->collage,
                'marital' => $item->marital,
                'children' => $item->children,
                'qualification' => $item?->qualification?->name,
                'job' => $item?->job?->name,
                'city' => $item?->city?->name,
                'link_name' => $item?->job?->link_name,
                'link' => $item->link,
                'cv' => $item->cv_link,
                'favourite' => $item->favourite,
            ];
        });
 
        return response()->json([
            'applications' => $applications
        ]);
    }

    public function favourites(Request $request){
        $applications = Application::
        with('qualification', 'job', 'city')
        ->where('favourite', 1)
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'birth_date' => $item->birth_date,
                'graduate_date' => $item->graduate_date,
                'address' => $item->address,
                'phone' => $item->phone,
                'experiences' => $item->experiences,
                'current_job' => $item->current_job,
                'courses' => $item->courses,
                'expected_salary' => $item->expected_salary,
                'university' => $item->university,
                'collage' => $item->collage,
                'marital' => $item->marital,
                'children' => $item->children,
                'qualification' => $item?->qualification?->name,
                'job' => $item?->job?->name,
                'city' => $item?->city?->name,
                'link_name' => $item?->job?->link_name,
                'link' => $item->link,
                'cv' => $item->cv_link, 
            ];
        });
 
        return response()->json([
            'applications' => $applications
        ]);
    }

    public function status(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'favourite' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        Application::
        where('id', $id)
        ->update([
            'favourite' => $request->favourite
        ]);

        return response()->json([
            'success' => $request->favourite ? "active" : "not_active"
        ]);
    }
    
    public function delete_application(Request $request, $id){
        Application::where('id', $id)
        ->delete();

        return response()->json([
            'success' => 'You delete data success'
        ]);
    }
}

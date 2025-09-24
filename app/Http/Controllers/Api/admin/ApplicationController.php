<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            ];
        });

        return response()->json([
            'applications' => $applications
        ]);
    }
}

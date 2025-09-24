<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Job;

class JobController extends Controller
{
    public function view(Request $request){
        $jobs = Job::
        get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'ar_name' => $item->translations->where('key', 'name')->first()?->value,
                'name' => $item->name,
                'status' => $item->status,
            ];
        });

        return response()->json([
            'jobs' => $jobs,
        ]);
    }

    public function status(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $jobs = Job::
        where('id', $id)
        ->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => $request->status ? 'active' : 'banned',
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'ar_name' => ['required'],
            'name' => ['required'],
            'status' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $jobs = Job::
        create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        $jobs->translations()->create([
            'locale' => 'ar',
            'key' => 'name',
            'value' => $request->ar_name,
        ]); 

        return response()->json([
            'success' => 'You add data success',
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'ar_name' => ['required'],
            'name' => ['required'],
            'status' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $jobs = Job::
        where('id', $id)
        ->first();
        $jobs->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        $jobs->translations()->delete();
        $jobs->translations()->create([
            'locale' => 'ar',
            'key' => 'name',
            'value' => $request->ar_name,
        ]); 

        return response()->json([
            'success' => 'You update data success',
        ]);
    }

    public function delete(Request $request, $id){
        Job::
        where('id', $id)
        ->delete();
        
        return response()->json([
            'success' => 'You delete data success',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\SecurityNum;

class SecurityNumController extends Controller
{
    public function view(){
        $secuirty_number = SecurityNum::
        select('id', 'number', 'status')
        ->orderByDesc('id')
        ->first();

        return response()->json([
            'secuirty_number' => $secuirty_number
        ]);
    }
    
    public function status(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $security_number = SecurityNum::orderByDesc('id')
        ->first();
        $security_number->status = $request->status;
        $security_number->save();

        return response()->json([
            'success' => $request->status ? 'active' : 'banned'
        ]);
    }
    
    public function create_update(Request $request){
        $validator = Validator::make($request->all(), [
            'number' => ['required'],
            'status' => ['required', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $secuirty_number = SecurityNum:: 
        orderByDesc('id')
        ->first();
        if(empty($secuirty_number)){
            SecurityNum::create([
                'number' => $request->number,
                'status' => $request->status,
            ]);
        }
        else{
            $secuirty_number->update([
                'number' => $request->number,
                'status' => $request->status,
            ]);
        }

        return response()->json([
            'success' => 'You make proccess success'
        ]);
    }
}

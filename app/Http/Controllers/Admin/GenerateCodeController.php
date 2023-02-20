<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Codes;

class GenerateCodeController extends Controller
{
    public function index(){
        return view('admin.generatecode.generate-code'); 
    }

    public function store(Request $request) {
        try {
            $data = $request->all();

            error_log( $data['name']);
            error_log( $data['code']);
            Codes::create(['name' => $data['name'], 'code' => $data['code'], 'status' => 'Available']);
            return 'Hello world';
        } catch(\Exception $e){
            return $e;
        }
    }
}

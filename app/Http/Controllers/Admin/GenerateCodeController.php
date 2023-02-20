<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Codes;
use App\Models\Templates;
use Illuminate\Support\Str;

class GenerateCodeController extends Controller
{
    public function index(){
        $templates = Templates::all();
        $codes = Codes::all();
        return view('admin.generatecode.generate-code', ['templates' => $templates, 'codes' => $codes]);
    }

    public function store(Request $request) {
        try {
            $data = $request->all();
            $digit = (int) $data['num_of_digit'];
            $code = $data['prefix'] . '_' . Str::random($digit);
            $template_id = $data['template_id'];

            return Codes::create(['code' => $code, 'template_id' => $template_id, 'status' => 'Available']);
        } catch(\Exception $e){
            return $e;
        }
    }
}

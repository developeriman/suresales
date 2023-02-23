<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Templates;

class TemplateController extends Controller
{
    public function index(){
        $templates = Templates::all();
        return view('/admin/template/newtemplate', ['templates' => $templates]);
    }

    function store(Request $request)
    {
        $data = $request->all();
        return Templates::create(['template' => json_encode($data['data']), 'name' => $data['name']]);
    }
}

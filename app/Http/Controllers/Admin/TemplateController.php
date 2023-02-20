<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Templates;

class TemplateController extends Controller
{
    public function index(){
        return view('/admin/template/newtemplate');
    }

    function store(Request $request)
    {
        $data = $request->all();
        return Templates::create(['template' => $data['template'], 'name' => $data['name']]);
    }
}

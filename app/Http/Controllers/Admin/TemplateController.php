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

    public function editTemplate(Request $request) {
        $id = $request->route('id');
        $template = Templates::where('id', $id)->first();
        return view('admin.edit_template', ['template' => $template, 'data' => json_decode($template->template, true)]);
    }

    public function update(Request $request) {
        $body = $request->all();
        $id = $request->route('id');
        $template = Templates::where('id', $id)->first();
        $template->name = $body['name'];
        $template->template = $body['data'];
        $template->save();
        return ['success' => true];
    }
}

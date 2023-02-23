<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Codes;
use App\Models\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileUpload extends Controller
{

    public function index(Request $request) {
        $code = $request->route('code');
        $code = Codes::where('code', $code)->first();
        return view('live_table', ['code' => $request->route('code'), 'schema_json' => $code->template->template, 'schema' => json_decode($code->template->template, true)]);
    }

    public function enterCode() {
        return view('admin.enter_code');
    }

    /**
     * Store the newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $code = Codes::where('code', $data['code'])->first();

        $code->status = 'Used';
        $code->save();

        return UploadFiles::create(
            [
                'title' => $data['title'],
                'code_id' => $code->id,
                'title' => $data['title'],
                'data' => $data['data'],
                'user_id' => Auth::id()
            ]
        );
    }

}

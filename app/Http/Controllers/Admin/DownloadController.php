<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UploadFiles;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class DownloadController extends Controller
{
    public function downloadFile(Request $request) {
        $fileData = UploadFiles::where('id', $request->route('id'))->first();
        $dataObj = json_decode($fileData->data, true);
        $headers = $dataObj[0];
        $dataObj = array_slice($dataObj, 1, count($dataObj) - 1);
        $export = new Excel();

        return $export->download($dataObj, 'Downloda.xlsx',  null, $headers);
    }
}

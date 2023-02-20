<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LiveTableController extends Controller
{
    function index()
    {
        return view('live_table');
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('tbl_sample')->orderBy('id','desc')->get();
        
            echo json_encode($data);
        }
    }

    function add_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                'user_id'     =>  $request->user_id,
                'first_name'    =>  $request->first_name,
                'last_name'     =>  $request->last_name,
                'full_name'     =>  $request->full_name,
                'phone'     =>  $request->phone,
               
            );
            $id = DB::table('tbl_sample')->insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        } 
    }

    function update_data(Request $request)
    {
        if($request->ajax())
        {
            $data = array(
                $request->column_name       =>  $request->column_value
            );
            DB::table('tbl_sample')
                ->where('id', $request->id)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function delete_data(Request $request)
    {
        if($request->ajax())
        {
            DB::table('tbl_sample')
                ->where('id', $request->id)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }
}

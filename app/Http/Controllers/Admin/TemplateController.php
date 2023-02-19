<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TemplateController extends Controller
{
    public function index(){
        return view('/admin/template/newtemplate');
    }
    function templatesave(Request $request)
    {
        $jr=$request->jr; 
        if(sizeof($jr) > 0)
        {
           
            foreach( $jr as $u )
            {
                    $data2 = array(
                    'FirstName' =>  $u[0],
                    'LastName' =>  $u[1],
                    'FullName' =>  $u[2],
                    'Phone' =>  $u[3],
                    'Photo' =>  $u[4]
                    );
                    $id = DB::table('tbl_templates')->insert($data2);
                    

            }
        }

    }
}

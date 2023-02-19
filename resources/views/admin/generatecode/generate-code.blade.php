@extends('admin.layout')
@section('page_title', 'Dashboard')
@section('dashboard_active', 'active')
@section('content')

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }


        #customers tr {
            text-align: center;
        }
    </style>
    <h2 style="padding: 20px">Add Code Generate</h2>
    <div class="panel panel-default">
        <div class="container">
            <form >
            @csrf
              <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <table id="customers">

                    <tr>
                        <td>Editable/typeable Dropdown</td>
                        <td>Input Text field</td>
                        <td>Input number field</td>
                    </tr>

                    <tr>
                        <td>
                            <select class="form-select" id="templatename">
                                <option>Select template</option>
                                <option value="template 1"> template1</option>
                              
                            </select>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputEmail1" 
                                style="font-size:15px;font-weight:bold">Prefix</label>
                                <input type="text" id="prefix" name="" class="form-control">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">No. Of
                                    Codes</label>
                                <input type="text" id="noofcodes" name=""  class="form-control">
                            </div>
                        </td>
                    </tr>

                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="generatecode" style="margin-top: 20px">Generate Code
                        Button</button>
                </div>
        </div>
        </form>

    </div>
    <div class="container" style="margin-top:40px;" class="table-responsive">
        <table id="customers">


            <tr>
                <td style="width: 96px;text-align:center;font-weight:bold" colspan="3">CODE LIST</td>

            </tr>
            <tr>
                <td style="width: 96px;">Generated Code</td>
                <td style="width: 96px;">Template Name</td>
                <td style="width: 96px;">Status</td>
            </tr>

            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>mary@example.com</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Dooley</td>
                <td>july@example.com</td>
            </tr>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/template/template.js') }}"></script>
@endsection

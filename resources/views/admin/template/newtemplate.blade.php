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
    <h2 style="text-align:center">Add New Template</h2>
    <div class="panel panel-default">
        @csrf
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="mb-3">
                    <table id="customers">
                        <tbody id="appendrow">
                            <tr>
                                <td><b>Title</b></td>
                                <td><b>Type</b></td>
                            </tr>
                            <tr id="template-row-1">
                                <td><input type="text" class="form-control" id="template-input-1" value=""></td>
                                <td>
                                    <select class="form-select" id="template-input-type-1">
                                        <option value="text">Text</option>
                                        <option value="number">Number</option>
                                        <option value="read_only">Read Only</option>
                                        <option value="image">Image</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <button type="submit" id="addrow" class="btn btn-primary" style="font-size: 12px">+ Add New Row</button>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-danger" style="font-size: 12px" onClick="removerow()">+ Delete Row</button>
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top: 20px">
            <div class="col-md-6">
                <button type="submit" id="savetemplate" class="btn btn-primary w-100" style="font-size: 12px">Save
                    Template</button>
            </div>
        </div>


    </div>
    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/template/template.js') }}"></script>

@endsection

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
            <div class="col-md-6" id="appendrow">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <button type="submit" id="addrow" class="btn btn-primary" style="font-size: 12px">+ Add New Row</button>
            </div>

        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-2">
                <button type="submit" id="savetemplate" class="btn btn-primary" style="font-size: 12px">Save
                    Template</button>
            </div>
        </div>

        </form>

    </div>
    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/template/template.js') }}"></script>

@endsection

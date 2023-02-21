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

    <div class="panel panel-default">
    <div class="container" style="margin-top:10px;" class="table-responsive">
        <div class="row justify-content-center">
        <table id="customers">

            <tr>
                <td style="width: 96px;text-align:center;font-weight:bold" colspan="4">DOWNLOAD DATA</td>

            </tr>
            <tr>
                <td style="width: 10px;">No.</td>
                <td style="width: 50px;">Code</td>
                <td style="width: 50px;">Title</td>
                <td style="width: 50px;">Files Link</td>
            </tr>

            <tr>
                <td>1</td>
                <td>batch_3kdsf</td>
                <td>Pro87</td>
                <td><a href="d" style="color:blue !important">Download</a></td>
            </tr>
       
            </tbody>
        </table>

    </div>
    </div>

    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/template/template.js') }}"></script>
@endsection

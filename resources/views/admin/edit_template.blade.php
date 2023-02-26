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
    <h2 style="text-align:center">Edit Template</h2>

    <br>
    <form style="text-align:center">
        <div style="width:30%; margin: 0 auto;">
            <div class="col-auto">
                <input type="text" value="{{ $template->name }}" class="form-control text-center" id="data_title" placeholder="TITLE *">
            </div>

        </div>
    </form>
    <br>

    <div class="panel panel-default">
        @csrf
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

        <input type="hidden" id="template_data" name="template_id" value="{{ $template->id  }}" />

        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="mb-3">
                    <table id="customers">
                        <thead>
                        <tr>
                            <td><b>Title</b></td>
                            <td><b>Type</b></td>
                        </tr>
                        </thead>
                        <tbody id="appendrow">
                        @foreach ($data as $index => $row)
                            @if ($index == 0)
                                @continue
                            @endif
                            <tr>
                                <td><input type="text" class="form-control" id="template-input-{{ $index + 1 }}" value="{{ $row['field'] }}"></td>
                                <td>
                                    <select class="form-select" value="{{ $row['type'] }}" id="template-input-type-{{ $index + 1 }}">
                                        <option value="text">Text</option>
                                        <option value="number">Number</option>
                                        <option value="read_only">Read Only</option>
                                        <option value="image">Image</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
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

        <div class="row mb-3 justify-content-center" style="margin-top: 20px">
            <div class="col-md-6">
                <button type="submit" id="savetemplate" class="btn btn-primary w-100" style="font-size: 12px">Save Template</button>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/template/template_edit.js') }}"></script>

@endsection

@extends('admin.layout')
@section('page_title', 'Dashboard')
@section('dashboard_active', 'active')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading text-center">UPLOAD DATA PAGE</div>
        <div class="panel-body">
            <div id="message"></div>


            <form style="text-align:center">
                <div style="width:30%; margin: 0 auto;">
                    <div class="col-auto">
                        <input type="text" class="form-control text-center" id="data_title" placeholder="TITLE *">
                    </div>

                </div>
            </form>

            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        @for ($i = 0; $i < count($schema); $i++)
                            <td> {{ $schema[$i]['field'] }}</td>
                        @endfor

                        <td>Action</td>
                    </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <button onclick="addNewRecord()" class="btn btn-primary">+ ADD</button>
                <hr style="border-top: 1.5px solid  rgb(127, 123, 123);">

                <form>
                    {{ csrf_field() }}

                    <input type="hidden" name="code" id="template_code" value="{{ $code }}" />

                    <div style="width: 100%">
                        <div>
                            <div class="divide-section">

                                <div class="input-left">
                                    <input style="opacity: 0; position: absolute;   z-index: -1; " id="inputTag" type="file" />
                                </div>

                                <div class="input-right" style="text-align:right">
                                    <button type="button" onclick="submitData()" class="btn btn-primary" value="Submit">Submit</button>
                                </div>

                            </div>

                            <div class="custom-file" style="border: 2px solid red;width:30%;height:15%;padding:4px;border-radius: 2px;">
                                <label
                                    class="custom-file-label"
                                    for="inputGroupFile01"
                                    style="color:red">UPLOAD/XLSX/CSV</label>

                                <input type="file" class="custom-file-input" id="fileInput">
                                <button type="button" id="uploadFile" class="form-control">Upload</button>
                            </div>

                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>

    <script>
        let schema = JSON.parse({!! json_encode($schema_json) !!});

        let xlsData;
        var selectedFile;
        document.getElementById("fileInput")
            .addEventListener("change", function(event) {
                event.preventDefault();
                selectedFile = event.target.files[0];
            });
        document
            .getElementById("uploadFile")
            .addEventListener("click", function() {
                if (selectedFile) {
                    var fileReader = new FileReader();
                    fileReader.onload = function(event) {
                        var data = event.target.result;
                        var workbook = XLSX.read(data, {
                            type: "binary"
                        });
                        workbook.SheetNames.forEach(sheet => {
                            xlsData = XLSX.utils.sheet_to_json(
                                workbook.Sheets[sheet], {
                                    header: 1
                                }
                            );
                            xlsData[0] = schema.map(data => data.field);

                            xlsData = xlsData.map(data => data.slice(0, schema.length));
                            setTableData();
                        });
                    };
                    fileReader.readAsBinaryString(selectedFile);
                }
            });

        function addNewRecord() {
            let body = '<tr>';
            body += addNewRow(Array(schema.length).fill(''), xlsData.length);
            body +=
                '<td><button type="button" class="btn btn-danger btn-xs delete" id="abc">Delete</button></td>';
            body += '</tr>';
            $('tbody').append(body);
            xlsData.push(Array(schema[0].length).fill(''));
        }

        function submitData() {

            let _token = $('input[name="_token"]').val();
            let title = $('#data_title').val();
            let code = $('#template_code').val();

            $.ajax({
                url: "/admin/file-upload/store",
                method: "POST",
                data: {
                    title: title,
                    data: JSON.stringify(xlsData),
                    code: code,
                    _token: _token
                },
                success: function(data) {
                    location.href = '/admin/dashboard'

                }
            });
        }

        function setTableData() {
            let data = xlsData;

            let body = '';
            for (let count = 1; count < data.length; count++) {
                body += `<tr id="tr-row-${count}">`;
                body += addNewRow(data[count], count);
                body +=
                    `<td><button type="button" class="btn btn-danger btn-xs delete" data-row="${count}" id="abc">Delete</button></td>`;
                body += '</tr>';
            }
            $('tbody').html(body);
        }

        function addNewRow(data, numRow) {
            let row = '';
            for (const [index, col] of data.entries()) {
                if(index === schema.length) {
                    break;
                }
                row +=
                    `<td ${schema[index].type === 'read_only' ? '' : 'contenteditable'} class="column_name editable-col" data-col="${index}" data-row="${numRow}">${col}</td>`;
            }
            return row;
        }

        $(document).ready(function() {

            var _token = $('input[name="_token"]').val();

            $(document).on('input', '.editable-col', function(e) {
                const content = e.target.textContent;
                const col = e.target.getAttribute('data-col');
                const row = e.target.getAttribute('data-row');
                xlsData[row][col] = content;
            });

            $(document).on('click', '.delete', function() {
                let row = $(this).attr("data-row");
                if (confirm("Are you sure you want to delete this records?")) {
                    $(`#tr-row-${row}`).remove();
                    xlsData.splice(row, 1);
                }
            });


        });
    </script>
@endsection

<!DOCTYPE html>
<html>

<head>
    <title>Live Table Insert Update Delete in Laravel using Ajax jQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>

</head>

<body>
    <br />
    <div class="container box">


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

                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                    <button class="btn btn-primary">+ ADD</button>
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
                                    <label class="custom-file-label" for="inputGroupFile01"
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
    </div>
</body>

</html>


<script>
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
                        setTableData();
                    });
                };
                fileReader.readAsBinaryString(selectedFile);
            }
        });

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
        let head = '<tr>';
        for (const col of data[0]) {
            head += `<td>${col}</td>`
        }
        head += `<td>Action</td>`
        head += `</tr>`;
        $('thead').html(head);

        let body = '';
        for (let count = 1; count < data.length; count++) {
            body += '<tr>';
            for (const col of data[count]) {
                body +=
                    `<td contenteditable class="column_name" data-column_name="user_id" data-id="row-${count}">${col}</td>`;
            }
            body +=
                '<td><button type="button" class="btn btn-danger btn-xs delete" id="abc">Delete</button></td>';
            body += '</tr>';
        }
        $('tbody').html(body);
    }

    $(document).ready(function() {

        var _token = $('input[name="_token"]').val();

        $(document).on('blur', '.column_name', function() {
            var column_name = $(this).data("column_name");
            var column_value = $(this).text();
            var id = $(this).data("id");

            if (column_value != '') {
                $.ajax({
                    url: "{{ route('livetable.update_data') }}",
                    method: "GET",
                    data: {
                        column_name: column_name,
                        column_value: column_value,
                        id: id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#message').html(data);
                    }
                })
            } else {
                $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
            }
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this records?")) {
                $.ajax({
                    url: "{{ route('livetable.delete_data') }}",
                    method: "GET",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#message').html(data);
                        fetch_data();
                    }
                });
            }
        });


    });
</script>

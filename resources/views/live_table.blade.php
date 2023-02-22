<!DOCTYPE html>
<html>

<head>
    <title>Live Table Insert Update Delete in Laravel using Ajax jQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"
    ></script>

</head>

<body>
    <br />
    <div class="container box">
        <h3 align="center">UPLOAD DATA PAGE</h3><br />

        <div class="panel panel-default">
            <div class="panel-heading">Sample Data</div>
            <div class="panel-body">
                <div id="message"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>USER ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
                    <hr style="border-top: 1.5px solid  rgb(127, 123, 123);">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="custom-file" style="border: 2px solid red;width:30%;height:15%;padding:4px;border-radius: 2px;">
                            <label class="custom-file-label" for="inputGroupFile01"
                                style="color:red">UPLOAD/XLSX/CSV</label>

                            <input type="file" class="custom-file-input" id="fileInput">
                            <button type="button" id="uploadFile" class="form-control">Upload</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>

</html>


<script>

    var selectedFile;
    document.getElementById("fileInput")
        .addEventListener ("change", function (event) {
            event.preventDefault();
            selectedFile = event.target.files[0];
        });
    document
        .getElementById("uploadFile")
        .addEventListener("click", function() {
            if (selectedFile) {
                var fileReader = new FileReader( );
                fileReader. onload = function (event) {
                    var data = event.target.result;
                    var workbook = XLSX.read( data, {
                        type: "binary"
                    });
                    workbook. SheetNames. forEach ( sheet => {
                        let rowobject = XLSX.utils.sheet_to_json(
                            workbook.Sheets[sheet], {header: 1}
                        );
                        setTableData(rowobject);
                    });
                };
                fileReader. readAsBinaryString(selectedFile);
            }
        });

    function setTableData(data) {
        let head = '<tr>';
        for(const col of data[0]) {
            head += `<td>${col}</td>`
        }
        head += `<td>Action</td>`
        head += `</tr>`;
        $('thead').html(head);

        let body = '';
        for (let count = 1; count < data.length; count++) {
            body += '<tr>';
            for(const col of data[count]) {
                body += `<td contenteditable class="column_name" data-column_name="user_id" data-id="row-${count}">${col}</td>`;
            }
            body +=
                '<td><button type="button" class="btn btn-danger btn-xs delete" id="abc">Delete</button></td>';
            body += '</tr>';
        }
        $('tbody').html(body);
    }
    $(document).ready(function() {

        fetch_data();



        var _token = $('input[name="_token"]').val();

        $(document).on('click', '#add', function() {
            var user_id = $('#user_id').text();
            var first_name = $('#first_name').text();
            var last_name = $('#last_name').text();
            var full_name = $('#full_name').text();
            var phone = $('#phone').text();

            if (first_name != '' && last_name != '' && user_id != '' && full_name != '' && phone !=
                '') {
                $.ajax({
                    url: "{{ route('livetable.add_data') }}",
                    method: "GET",
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        user_id: user_id,
                        full_name: full_name,
                        phone: phone,
                        _token: _token
                    },
                    success: function(data) {
                        $('#message').html(data);
                        fetch_data();
                    }
                });
            } else {
                $('#message').html("<div class='alert alert-danger'>Every Fields are required</div>");
            }
        });

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

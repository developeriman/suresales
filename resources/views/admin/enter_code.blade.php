
@extends('admin.layout')
@section('page_title','Dashboard')
@section('dashboard_active','active')
@section('content')
<div class="container box">
    <div class="panel panel-default"><br>
        <div class="panel-heading text-center"; style="font-size: 20px;font-weight:bold">UPLOAD DATA PAGE</div><br>
        <div class="panel-body">
            <div class="table-responsive">
                <form>
                    <div>
                        <div class="input-left">
                            <input class="form-group" style="padding: 3px;border: 1px solid gray" placeholder="Enter your code" id="template_code" type="text" />
                        </div>

                        <div class="input-right">
                            <button type="button" onclick="submitData()" class="btn btn-primary" value="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>

    function submitData() {

        let code = $('#template_code').val();

        location.href = `/admin/file-upload/table/${code}`
    }
</script>

@endsection

@extends('admin.layout')
@section('page_title', 'Dashboard')
@section('dashboard_active', 'active')
@section('content')
    <h2>Add Code Generate</h2>
    <div class="panel panel-default" style="margin-top: 180px">
        <div class="container">
            <form action="" method="POST">
                @csrf
                <table class="table table-bordered" style="border-color:black;">
                  
                    <tbody>
                        <tr>
                            <div class="form-group d-flex justify-content-center" style="width: 300px;">
                                <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold;margin-botton:4px;
                                ">UPLOAD DATA PAGE</label><br><br>
                                <input type="text" class="form-control" placeholder="Title">
                            </div>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">*USERID</label>
                                    <input type="text" class="form-control" placeholder="User Id">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">FirstName</label>
                                    <input type="text" class="form-control" placeholder="First Name">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">LastName</label>
                                    <input type="text" class="form-control" placeholder="Last Name">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">FullName</label>
                                    <input type="text" class="form-control" placeholder="Full Name">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-size:15px;font-weight:bold">Upload...</label>
                                    <input type="file" class="form-control">
                                </div>
                            </td>

                        
                            <td>
                                <div class="form-group">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="37" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Generate Code Button</button>
                </div>
        </div>
        </form>

    </div>
 

    <script type="text/javascript" src="{{ asset('admin/Asset/jquery/jquery.min.js') }}"></script>
@endsection

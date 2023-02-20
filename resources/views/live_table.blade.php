<!DOCTYPE html>
<html>
 <head>
  <title>Live Table Insert Update Delete in Laravel using Ajax jQuery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
         <th>File</th>
         <th>Delete</th>
        </tr>
       </thead>
       <tbody>
       
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 fetch_data();

 function fetch_data()
 {
  $.ajax({
   url:"/livetable/fetch_data",
   dataType:"json",
   success:function(data)
   {
    var html = '';
    html += '<tr>';
    html += '<td contenteditable id="user_id"></td>';     
    html += '<td contenteditable id="first_name"></td>';
    html += '<td contenteditable id="last_name"></td>';
    html += '<td contenteditable id="full_name"></td>';
    html += '<td contenteditable id="phone"></td>';
    html += '<td contenteditable id="file"></td>';

    html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
    for(var count=0; count < data.length; count++)
    {
     html +='<tr>';
     html += '<td contenteditable class="column_name" data-column_name="user_id" data-id="'+data[count].id+'">'+data[count].user_id+'</td>';
     html +='<td contenteditable class="column_name" data-column_name="first_name" data-id="'+data[count].id+'">'+data[count].first_name+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="last_name" data-id="'+data[count].id+'">'+data[count].last_name+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="full_name" data-id="'+data[count].id+'">'+data[count].full_name+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="phone" data-id="'+data[count].id+'">'+data[count].phone+'</td>';
     html += '<td contenteditable class="column_name" data-column_name="file" data-id="'+data[count].id+'">'+data[count].file+'</td>';

     html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
    }
    $('tbody').html(html);
   }
  });
 }

 var _token = $('input[name="_token"]').val();

 $(document).on('click', '#add', function(){
    var user_id = $('#user_id').text();
  var first_name = $('#first_name').text();
  var last_name = $('#last_name').text();
  var full_name = $('#full_name').text();
  var phone = $('#phone').text();
  var f = $('#file').file();

  if(first_name != '' && last_name != '' && user_id != '' && full_name != '' && phone != '' && file != '')
  {
   $.ajax({
    url:"{{ route('livetable.add_data') }}",
    method:"GET",
    data:{first_name:first_name, last_name:last_name,user_id:user_id ,full_name:full_name, phone:phone, file:file,_token:_token},
    success:function(data)
    {
     $('#message').html(data);
     fetch_data();
    }
   });
  }
  else
  {
   $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
  }
 });

 $(document).on('blur', '.column_name', function(){
  var column_name = $(this).data("column_name");
  var column_value = $(this).text();
  var column_value = $(this).file();
  var id = $(this).data("id");
  
  if(column_value != '')
  {
   $.ajax({
    url:"{{ route('livetable.update_data') }}",
    method:"GET",
    data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
    }
   })
  }
  else
  {
   $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
  }
 });

 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this records?"))
  {
   $.ajax({
    url:"{{ route('livetable.delete_data') }}",
    method:"GET",
    data:{id:id, _token:_token},
    success:function(data)
    {
     $('#message').html(data);
     fetch_data();
    }
   });
  }
 });


});
</script>
var makeContact = [];
var slno = 0;
var checkfield = -1;
$(document).ready(function() {
		console.log('here')
		addmore();

		$('#generatecode').click(function() 
		{
		//alert('addrow')
		    var templatename = $('#templatename').val();
			var prefix = $('#prefix').val();
			var noofcodes = $('#noofcodes').val();
			
		    var _token = $('input[name="_token"]').val();

			$.post('./generatecode', {'templatename': templatename,'prefix':prefix,'noofcodes':noofcodes,'_token':_token}, function (data) {

               console.log('data.....'+ data)
			

            });

        });

		$('#savetemplate').click(function() 
		{
		//alert('addrow')
		    var _token = $('input[name="_token"]').val();
			for(io = 1; io<=slno; io++)
			{
			AddProduct(io);
			}
			$.post('./templatesave', {'jr': makeContact,'_token':_token}, function (data) {

               console.log('data.....'+ data)
				slno = 0;
				$('#appendjournal').html('');

            });

        });
	

		$('#addrow').click(function() 
		{
		//alert('addrow')
		slno++;
		$('#appendrow').append('<div  class="mb-3"  id="data' + slno + '"><table id="customers"><tr><td><b>Title</b></td><td><b>Type</b></td></tr><tr><td>First Name</td><td><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')" id="FirstName' + slno + '" value=""></td></tr><tr><td>Last Name</td><td><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')" id="LastName' + slno + '" value=""></td></tr><tr><td>Full Name</td><td><input type="text" class="form-control" id="FullName' + slno + '" value=""></td></tr><tr><td>Phone</td><td><input type="text" class="form-control" id="Phone' + slno + '" value=""></td></tr><tr><td>Picture</td><td><input type="file" class="form-control" id="picture' + slno + '" value=""></td><tr> <tr><td></td><td><button type="submit" class="btn btn-danger" style="font-size: 12px" onClick=\'removerow("' + slno + '")\'>+ Delete Row</button></td></tr></table></div');
		});

		});
		function addmore()
		{
		slno++;
		$('#appendrow').append('<div class="mb-3" id="data' + slno + '"><table id="customers"><tr><td><b>Title</b></td><td><b>Type</b></td></tr><tr><td>First Name</td><td><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')" id="FirstName' + slno + '" value=""></td></tr><tr><td>Last Name</td><td><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')" id="LastName' + slno + '" value=""></td></tr><tr><td>Full Name</td><td><input type="text" class="form-control" id="FullName' + slno + '" value=""></td></tr><tr><td>Phone</td><td><input type="text" class="form-control" id="Phone' + slno + '" value=""></td></tr><tr><td>Picture</td><td><input type="file" class="form-control" id="picture' + slno + '" value=""></td><tr> <tr><td><td style="text-align: right"><button type="submit" class="btn btn-danger" style="font-size: 12px" onClick=\'removerow("' + slno + '")\'>+ Delete Row</button></td></tr></table></div');
	
	//	$('#appendrow').append('<div class="col-md-3" id="data' + slno + '"><div><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')"  id="FirstName' + slno + '" value=""></div><div><input type="text" class="form-control" onkeyup="setFullname(' + slno + ', ' + slno + ')" id="LastName' + slno + '" value=""></div><div><input type="text" class="form-control" id="FullName' + slno + '" value=""></div><div><input type="text" class="form-control" id="Phone' + slno + '" value=""></div><div><input type="file" class="form-control" id="picture' + slno + '" value=""></div></div>');

		}
		function removerow(x)
		{

		$('#data' + x).remove();
		slno--;
		}
		function setFullname(x)
		{
			var m = $('#FirstName' + x).val();
			var n = $('#LastName' + x).val();
			var fullname = m + ' ' +n;
			$('#FullName' + x).val(fullname);
		}
function AddProduct(x)
{
var FirstName = $('#FirstName'+x).val();
var LastName = $('#LastName'+x).val();
var FullName = $('#FullName'+x).val();
var Phone = $('#Phone'+x).val();
var picture = $('#picture'+x).val();

 makeContact.push([FirstName, LastName, FullName, Phone, picture]);
  
}

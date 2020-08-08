<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CRUD APP</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet" />

	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
</head>

<body>
	<style>
		.container {
			padding: 2%;
		}
	</style>
	<div class="container">

		<h2 class="alert alert-success" style="color: #757575;">
			<span style="text-align:left; font-size:15px; color:black; font-weight:bold;"> Welcome {{ Auth::user()->name }}</span>
			<span style="text-align:center; font-size:27px; margin-left:20%"> CRUD APPLICATION</span>
		</h2>

		<div class="row">
			<button class="btn btn-info btn-sm" style="margin-right:65%;" data-toggle="modal" data-target="#exampleModal">Add New Student</button>
			<!--<button class="btn btn-info btn-sm" style="margin-right:35%;">Logout</button>-->
			<button class="btn btn-danger btn-sm" style="margin-left:10%;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
				{{ __('Logout') }}
			</button>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
		<div class="col-md-12">

			@if($message = Session::get('success'))
			<div class="alert-success fade-message">
				<p>{{$message}}</p>
			</div>
			<script>
				$(function() {
					setTimeout(function() {
						$('.fade-message').slideUp();
					}, 5000);
				});

				$(function() {
					$('[data-toggle="tooltip"]').tooltip()
				})
			</script>
			@endif
		</div>
		<br>
		<table id="dtMaterialDesignExample" class="table" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="th-sm">#</th>
					<th class="th-sm">First Name</th>
					<th class="th-sm">Last Name</th>
					<th class="th-sm">Gender</th>
					<th class="th-sm">Country</th>
					<th class="th-sm">City</th>
					<th class="th-sm">Address</th>
					<th class="th-sm">Action</th>
				</tr>
			<tbody>
				@foreach($students as $key=> $student)
				<tr>
					<td>{{$students->firstItem() + $key}}</td>
					<td>{{$student->firstname}}</td>
					<td>{{$student->lastname}}</td>
					<td>{{$student->gender}}</td>
					<td>{{$student->country}}</td>
					<td>{{$student->city}}</td>
					<td>{{$student->address}}</td>
					<td>
						<!--<a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">Add</a>
								<a data-student_id="{{$student->id}}" data-firstname="{{$student->firstname}}" data-lastname="{{$student->lastname}}" data-gender="{{$student->gender}}" data-country="{{$student->country}}" data-city="{{$student->city}}" data-address="{{$student->address}}" data-target="#exampleModal-show" data-toggle="modal" type="button" class="btn btn-secondary btn-sm">Show</a>-->
						<!-- EDIT BUTTON  CODE STARTS HERE -->
						<button data-placement="top" title="Edit Record" data-student_id="{{$student->id}}" data-firstname="{{$student->firstname}}" data-lastname="{{$student->lastname}}" data-gender="{{$student->gender}}" data-country="{{$student->country}}" data-city="{{$student->city}}" data-address="{{$student->address}}" data-toggle="modal" data-target="#exampleModal-edit" type="button" class="btn btn-info btn-sm">Edit</button>
						<!-- EDIT BUTTON CODE ENDS HERE	-->
						<button data-placement="right" title="Delete Record" data-student_id="{{$student->id}}" data-target="#exampleModal-delete" data-toggle="modal" class="btn btn-danger btn-sm">Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
			{{$students->links()}}
			<tfoot>
				<tr>
					<th>#
					</th>
					<th>First Name
					</th>
					<th>Last Name
					</th>
					<th>Gender
					</th>
					<th>Country
					</th>
					<th>City
					</th>
					<th>Address
					</th>
					<th>Action
					</th>
				</tr>
			</tfoot>
			</thead>
		</table>

		<!--- ADD NEW STUDENT MODAL  -->

		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="modal fade right" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-notify" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<h5 class="card-header info-color white-text text-center py-4">
							<strong>Add New Student</strong>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
						</h5>
						<div class="card-body px-lg-5 pt-0">
							<form action="{{route ('student.store')}}" method="POST" style="color: #757575;">
								@csrf
								<br><label for="materialRegisterFormFirstName">First name</label><br>
								<input type="text" id="firstname" class="form-control" name="firstname">

								<br><label for="materialRegisterFormLastName">Last name</label><br>
								<input type="text" id="lastname" class="form-control" name="lastname">

								<br><label for="materialRegisterFormGender">Gender</label><br>
								<input type="text" id="gender" class="form-control" name="gender">

								<br><label for="materialRegisterFormCountry">Country</label><br>
								<input type="text" id="country" class="form-control" name="country">

								<br><label for="materialRegisterFormCity">City</label><br>
								<input type="text" id="city" class="form-control" name="city">

								<br><label for="materialRegisterFormAddress">Address</label><br>
								<input type="text" id="address" class="form-control" name="address">

								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="this.form.reset()">Close</button>
									<button type=" button" class="btn btn-primary">Save Student</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ADD NEW STUDENT ENDS HERE-->



		<!--- EDIT STUDENT MODAL  -->

		<!-- Button trigger modal -->
		<!-- Modal -->
		<!-- Modal -->
		<div class="modal fade left" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-notify modal-lg modal-info" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{route('student.update', 'student_id')}}" method="POST" style="color: #757575;">
							@csrf
							@method('PUT')

							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Firstname and Lastname</span>
								</div>
								<input type="text" class="form-control" id="firstname" name="firstname">
								<input type="text" class="form-control" id="lastname" name="lastname">
							</div>
							<input type="hidden" id="student_id" name="student_id">
							<br>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Gender and Country</span>
								</div>
								<input type="text" class="form-control" id="gender" name="gender">
								<input type="text" class="form-control" id="country" name="country">
							</div>

							<br>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> City and Address</span>
								</div>
								<input type="text" class="form-control" id="city" name="city">
								<input type="text" class="form-control" id="address" name="address">
							</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Update Student</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- EDIT STUDENT ENDS HERE-->

		<!--- DELETE STUDENT MODAL  -->
		<!-- Modal -->
		<div class="modal fade top" id="exampleModal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-notify modal-info" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title modal-title-centered" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="{{route('student.destroy','student_id')}}" method="POST" style="color: #757575;">
						<div class="modal-body">
							@csrf
							@method('DELETE')

							<input type="hidden" id="student_id" name="student_id">
							<p class="text-center" width="50px">Are you sure you want to delete this student?</p>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-dismiss="modal">No/Cancel</button>
							<button type="submit" class="btn btn-danger">Yes/Delete Student</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- DELETE STUDENT ENDS HERE-->


		<!--- SHOW STUDENT MODAL  -->

		<!-- Button trigger modal -->
		<!-- Modal -->
		<!-- Modal -->
		<div class="modal fade bottom" id="exampleModal-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-notify modal-lg modal-info" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="{{route('student.show', 'student_id')}}" method="GET" style="color: #757575;">
							@csrf
							<!--@method('GET')-->

							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Firstname and Lastname</span>
								</div>
								<input type="text" class="form-control" id="firstname" name="firstname">
								<input type="text" class="form-control" id="lastname" name="lastname">
							</div>
							<input type="hidden" id="student_id" name="student_id">
							<br>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Gender and Country</span>
								</div>
								<input type="text" class="form-control" id="gender" name="gender">
								<input type="text" class="form-control" id="country" name="country">
							</div>

							<br>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> City and Address</span>
								</div>
								<input type="text" class="form-control" id="city" name="city">
								<input type="text" class="form-control" id="address" name="address">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								<!--<button type="submit" class="btn btn-info">Show Student</button>-->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- SHOW STUDENT ENDS HERE-->
	</div>
	</div>
	</div>
	</div>
</body>
<script>
	$('#exampleModal-edit').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var student_id = button.data('student_id')
		var firstname = button.data('firstname')
		var lastname = button.data('lastname')
		var gender = button.data('gender')
		var country = button.data('country')
		var city = button.data('city')
		var address = button.data('address')


		var modal = $(this)
		modal.find('.modal-title').text('Edit Student Information');
		modal.find('.modal-body #student_id').val(student_id);
		modal.find('.modal-body #firstname').val(firstname);
		modal.find('.modal-body #lastname').val(lastname);
		modal.find('.modal-body #gender').val(gender);
		modal.find('.modal-body #country').val(country);
		modal.find('.modal-body #city').val(city);
		modal.find('.modal-body #address').val(address);

		debugger

	});

	$('#exampleModal-delete').on('show.bs.modal', function(event) {

		var button = $(event.relatedTarget)
		var student_id = button.data('student_id')

		var modal = $(this)
		modal.find('.modal-title').text('Delete Student Record');
		modal.find('.modal-body #student_id').val(student_id);
	});

	$('#exampleModal-show').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var student_id = button.data('student_id')
		var firstname = button.data('firstname')
		var lastname = button.data('lastname')
		var gender = button.data('gender')
		var country = button.data('country')
		var city = button.data('city')
		var address = button.data('address')

		var modal = $(this)
		modal.find('.modal-title').text('Preview Student Record');
		modal.find('.modal-body #student_id').val(student_id);
		modal.find('.modal-body #firstname').val(firstname);
		modal.find('.modal-body #lastname').val(lastname);
		modal.find('.modal-body #gender').val(gender);
		modal.find('.modal-body #country').val(country);
		modal.find('.modal-body #city').val(city);
		modal.find('.modal-body #address').val(address);
	});
</script>

</html>
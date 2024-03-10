<!doctype html>
<html lang="en">

<head>
	<!-- meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('adminbackend/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('adminbackend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet">
	<title>Register</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">
							<img src="{{asset('adminbackend/assets/images/logo-img.png')}}" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class=" p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign Up</h3>
										<p>Already have an account? <a href="{{ route('admin.login') }}">Sign in here</a>
										</p>
									</div>
									

									</div>
									<div class="form-body">
										<form method="POST" action="{{ route('register') }}" class="row g-3">
											@csrf

                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{session('status')}}
                                                </div>
                                            @elseif (session('error'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{session('error')}}
                                                </div>
                                            @endif
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Full Name</label>
												<input type="text" name="name" class="form-control" id="name" placeholder="Enter Full Name">
											</div>

                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
											

                                            <div class="col-12">
												<label for="inputEmailAddress" class="form-label">User Name</label>
												<input type="text" name="username" class="form-control" id="inputEmailAddress" placeholder="Enter Username">
											</div>

                                            @error('username')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
											

                                            <div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email</label>
												<input type="email" name="email" id="email"  class="form-control" id="inputEmailAddress" placeholder="Enter Email">
											</div>

                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
											
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>

                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                            <div class="col-12">
												<label for="inputChoosePassword" class="form-label">Confirm Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password_confirmation"  class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>

                                            @error('cf_password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
											
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('adminbackend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('adminbackend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{asset('adminbackend/assets/js/app.js')}}"></script>
</body>

</html>
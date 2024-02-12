<?php $this->load->view('inc/head',array("pageData"=>$pageData)) ?>
<?php $this->load->view('inc/top_header') ?>
<?php $this->load->view('inc/header'); ?>
<style>
	.error ,p{
		color:#f74b16!important;
	}
</style>
<section class="login-sec padding-top-30 padding-bottom-100">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h5 id="form_head">User Profile</h5>

				<!-- Profile FORM -->
				<form id="profile_form">
					<ul class="row">
						<li class="col-sm-12" id="fname_li">
							<label>First Name</label>
							<input type="text" class="form-control" name="fname" placeholder="" id="fname"
								style="color:#000!important;background-color:#fff!important" readonly>
						</li>
						<li class="col-sm-12" id="lname_li">
							<label>Last Name</label>
							<input type="text" class="form-control" name="lname" placeholder="" id="lname"
								style="color:#000!important;background-color:#fff!important" readonly>
						</li>
						<li class="col-sm-12" id="email_li">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="" id="email"
								style="color:#000!important">
								<span class="email_err" style="color:#f74b16!important"></span>
						</li>
						<li class="col-sm-12" id="phone_li">
							<label>Phone No.</label>
							<input type="text" class="form-control" name="phone" placeholder="" id="phone"
								style="color:#000!important">
								<span class="phone_err" style="color:#f74b16!important"></span>
						</li>
						<li class="col-sm-12 text-left">
							<button type="submit" class="btn-round">Update</button>
						</li>
					</ul>
				</form>

				<h5 id="form_head" style="margin-top: 50px!important;">Update Password</h5>
				<form id="updatePasswordForm">
					<ul class="row">
						<li class="col-sm-12" id="password_li">
							<label>Old Password
								<input type="password" class="form-control user_login_email" name="old_pass" placeholder="">
								<span class="mx-2 old_password_err" style="color:#f74b16!important"></span>
							</label>
						</li>
						<li class="col-sm-12">
							<label>New Password
								<input type="password" class="form-control user_login_email" name="new_pass" id="new_pass" placeholder="">
								<span class="mx-2 new_password_err" style="color:#f74b16!important"></span>
							</label>
						</li>
						<li class="col-sm-12">
							<label>Confirm Password
								<input type="password" class="form-control user_login_email" name="confirm_pass" placeholder="">
								<span class="mx-2" style="color:#f74b16!important"></span>
							</label>
						</li>
						<li class="col-sm-12 text-left">
							<button type="submit" class="btn-round">Submit</button>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	</div>
</section>

<?php  $this->load->view('inc/footer'); ?>

<script>
	$(document).ready(function () {

		//profile form validation
		$("#profile_form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
				pass: {
					required: true,
					minlength: 6,
					maxlength: 20
				},
				phone: {
					required: true,
					number: true,
					maxlength: 10,
					minlength: 10,
				}
			},
			messages: {
				phone: {
					required: "Please Enter your Mobile Number",
					number: "Please enter Valid Phone Number",
					maxlength: "Please Enter Valid Phone Number",
					minlength: "Please Enter Valid Phone Number",
				},
				email: {
					required: "Please Enter Your Email",
					email: "Please Enter Valid Email"
				},
				pass: {
					required: "Please Enter Your Password.",
					minlength: "Your password must be contains at least 6 chars",
					maxlength: "Your password is too long"
				}
			},
		})


		//Update password form validation 

		$("#updatePasswordForm").validate({
			rules: {
				old_pass: {
					required: true,
				},
				new_pass: {
					required: true,
					minlength: 6,
					maxlength: 20
				},
				confirm_pass: {
					equalTo:"#new_pass",
					required: true,
					minlength: 6,
					maxlength: 20,
				}
			},
			messages: {
				old_pass: {
					required: "Please Enter Old Password",
					minlength: "Please Enter at least 6 characters",
					maxlength: "Password length is too long",
				},
				new_pass: {
					required: "Please Enter New Password",
					minlength: "Please Enter at least 6 characters",
					maxlength: "Password length is too long",
				},
				confirm_pass: {
					required: "Please Enter Confirm Password.",
					minlength: "Please Enter at least 6 characters",
					maxlength: "Password length is too long",
				}
			},
		})

		// Update Profile Ajax Request

		var isFirstRequest = true;
		$("#profile_form").submit(function (e) {
			e.preventDefault();
			if ($(this).valid()) {
				if (isFirstRequest == true) {
					isFirstRequest = false;
					const frmData = new FormData(this);
					$.ajax({
						url: "<?= base_url().'account/update_account' ?>",
						type: "POST",
						dataType: "json",
						data: frmData,
						contentType: false,
						processData: false,
						success: function (response) {
							isFirstRequest = true;
							if (response.success == 1) {
								setTimeout(() => {
									Swal.fire(
										'Profile Updated Successfully!',
										'', 
										'success'
									)
								})
							}
							if (response.error == 1) {
								if(response.errorCode == 101){

									$(".email_err").html(response.data.email)
									$(".phone_err").html(response.data.phone)
								}
								if(response.errorCode == 102){
									$(".email_err").html("Email Already Exist Try Different One")
								}
							}
						},
						onError: function (err) {
							console.log(err);
						}
					})
				}
			}
		})


		//Update Password Ajax Request

		var isFirstRequest = true;
		$("#updatePasswordForm").submit(function (e) {
			e.preventDefault();
			if ($(this).valid()) {
				if (isFirstRequest == true) {
					isFirstRequest = false;
					const frmData = new FormData(this);
					$.ajax({
						url: "<?= base_url().'account/is_valid_password' ?>",
						type: "POST",
						dataType: "json",
						data: frmData,
						contentType: false,
						processData: false,
						success: function (response) {
							isFirstRequest = true;
							if (response.data.success == 1) {
							
								setTimeout(() => {
									Swal.fire(
										'Password  Updated Successfully!',
										'your new Password is='+$("#new_pass").val(),
										'success'
									)
								})
							}
							if (response.error == 1) {
								if (response.errorCode == 101) {
									setTimeout(() => {
										Swal.fire(
											'New Password And Conform password not matched!',
											'try Again',
											'error'
										)
									})
								}
								if (response.errorCode == 102) {
									setTimeout(() => {
										Swal.fire(
											'Invalid Password',
											'try Again',
											'error'
										)
									})
								}
								if (response.errorCode == 103) {
									setTimeout(() => {
										Swal.fire(
											'Something Went Wrong!',
											'try Again',
											'error'
										)
									})
								}
								if (response.errorCode == 104) {
							
								$(".new_password_err").html(response.data.new_password_error)
								}
							}
						},
						onError: function (err) {
							console.log(err);
						}
					})
				}
			}
		})

		//fetching userdata
		$.ajax({
			url: "<?= base_url().'account/account_details' ?>",
			type: "POST",
			dataType: "json",
			success: function (response) {
				if (response.data.success == 1) {
					$("#fname").val(response.data.data[0].fname);
					$("#lname").val(response.data.data[0].lname);
					$("#email").val(response.data.data[0].email);
					$("#phone").val(response.data.data[0].phone);
				}
				if (response.error == 1 && response.errorCode == 101) {
					console.log(response.error);
				}
			},
			onError: function (err) {
				console.log(err);
			}
		})



	})
</script>
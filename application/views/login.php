	<!-- Links -->

	<?php $this->load->view('inc/head',array("pageData"=>$pageData)) ?>
	<?php $this->load->view('inc/top_header') ?>
	<?php $this->load->view('inc/header'); ?>


	<!-- Linking -->
	

	<section class="login-sec padding-top-30 padding-bottom-100">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<!-- Login Your Account -->
					<h5 id="form_head">Login Your Account</h5>

					<!-- FORM -->
					<form id="login_form">
						<ul class="row">
							<li class="col-sm-12">
								<label>Email
									<input type="email" class="form-control user_login_email" name="email" id="email" placeholder="">
									<span id="email_err" class="text-danger mx-2"></span>
								</label>
							</li>
							<li class="col-sm-12">
								<label>Password
									<input type="password" class="form-control user_login_password" name="password" id="password"
										placeholder="">
									<span id="pass_err" class="text-danger mx-2"></span>
								</label>
							</li>
							<li class="col-sm-6">
								<div class="checkbox checkbox-primary">
									<input id="cate1" class="styled" type="checkbox">
									<label for="cate1"> Keep me logged in </label>
								</div>
							</li>
							<li class="col-sm-6"> <a href="#" class="forget">Forgot your password?</a> </li>
							<li class="col-sm-12 text-left">
								<button type="submit" class="btn-round">Login</button>
								<a href="<?=base_url().'Account/register'?>" class="text-info" style="margin-left:75px!important">Don't
									have Account ? Register now</a>
							</li>
						</ul>
					</form>

					<form id="forgetPassword_form">
						<ul class="row">
							<li class="col-sm-12">
								<label>Email
									<input type="email" class="form-control user_login_email" name="forget_email" id=""
										placeholder="">
									<span class="mx-2 email_err" style="color:#f93632!important"></span>
								</label>
							</li>
							<li class="col-sm-12 text-left">
								<button type="submit" class="btn-round">Submit</button>
								<button type="button" class="btn-round" id="back_btn"
									style="background-color:#db3545!important;color:#fff!important">Back</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
			<!-- Don’t have an Account? Register now -->

		</div>
		</div>
	</section>
	<?php  $this->load->view('inc/footer'); ?>
	
	<script>
		$(document).ready(function () {
			$("#forgetPassword_form").hide('slow');
			$("#login_form").validate({
				rules: {
					email: {
						required: true,
						email: true,
					},
					password: {
						required: true,
						minlength: 6,
						maxlength: 20
					}
				},
				message: {
					email: {
						required: "Please Enter Email",
						email: "Please enter valid email"
					},
					password: {
						required: "Please enter password",
						minlength: "Please ensure your password consists of a minimum of 6 characters.",
						maxlength: "Your password is too long"
					}
				},
			})


			var isFirstSubmitRequest = true;
			$("#login_form").submit(function (e) {
				if ($(this).valid()) {
					if (isFirstSubmitRequest == true) {

						e.preventDefault();
						const frmData = new FormData(this);
						$.ajax({
							url: "<?= base_url().'account/process_login'?>",
							type: "POST",
							dataType: "json",
							data: frmData,
							contentType: false,
							processData: false,
							success: function (response) {
								isFirstSubmitRequest = true;
								if (response.success == 1) {
									location.href = "<?=base_url()?>"
									// $("#email_err").html("")
									// $("#pass_err").html("")
									// $("#login_form")[0].reset();
								}
								if (response.error == 1 && response.errorCode == 102) {
									setTimeout(() => {
										Swal.fire(
											'Invalid Credentials',
											'Login Failed',
											'error'
										)
									})
								}
								if (response.error == 1 && response.errorCode == 101) {
									$("#email_err").html(response.data.email)
									$("#pass_err").html(response.data.pass)
								}
							},
							onError: function (err) {
								console.log(err);
							}
						})
					}
				}
			})

			$(".forget").click(function (e) {
				e.preventDefault();
				$("#login_form").hide('slow');
				$("#forgetPassword_form").show('slow');
				$("#form_head").text("Forget Password");

			})

			// forget password validation
			$("#forgetPassword_form").validate({
				rules: {
					forget_email: {
						required: true,
						email: true,
					},
					messages: {
						forget_email: {
							required: "Please Enter Email",
							email: "Please enter valid email"
						},
					}
				}
			})
			// forget password ajax
			let forgetPasswordRequest = true;
			$("#forgetPassword_form").submit(function (e) {
				if ($(this).valid()) {
					if (forgetPasswordRequest == true) {
						forgetPasswordRequest = false;
						e.preventDefault();
						const frmData = new FormData(this);
						$.ajax({
							url: "<?= base_url().'account/forgot_password'?>",
							type: "POST",
							dataType: "json",
							data: frmData,
							contentType: false,
							processData: false,
							success: function (response) {
								forgetPasswordRequest = true;
								$(".email_err").html(response.message);
								if (response.success == 1) {
									setTimeout(() => {
										Swal.fire(
											'Paste these URL into next tab to verify',
											response.data.link,
											'info'
										)
									})
								}
								if(response.error == 1){
									if(response.errorCode == 101){
										$(".email_err").html('<span class="text-danger">'+response.message+'</span>');
									}
								}
							},
							error: function (err) {
								console.log(err);
							}
						})
					}
				}
			})
			$("#back_btn").click(function (e) {
				e.preventDefault();
				$("#login_form").show('fadeIn');
				$("#forgetPassword_form").hide('slow');
				$("#form_head").text("Login Your Account");
			})
			
		})
	</script>
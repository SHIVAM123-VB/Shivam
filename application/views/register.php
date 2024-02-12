	<!-- Links -->
	<?php $this->load->view('inc/head',array("pageData"=>$pageData)) ?>
	<?php $this->load->view('inc/top_header') ?>
	<?php $this->load->view('inc/header'); ?>
	
	
	<!-- Blog -->
	<section class="login-sec padding-top-30 padding-bottom-100">
		<div class="container">
			<div class="row">

				<div class="col-md-6">
					<h5>Register</h5>

					<!-- FORM -->
					<form id="signup_form">
						<ul class="row">
							<li class="col-sm-12" id="fname_li">
								<label>First Name</label>
								<input type="text" class="form-control" name="fname"  placeholder="" style="color:#000!important">
							</li>
							<li class="col-sm-12" id="lname_li">
								<label>Last Name</label>
								<input type="text" class="form-control" name="lname" placeholder=""  style="color:#000!important">
							</li>

							<li class="col-sm-12" id="email_li">
								<label>Email</label>
								<input type="email" class="form-control" name="email" placeholder=""  style="color:#000!important">
							</li>

							<li class="col-sm-12" id="phone_li">
								<label>Phone No.</label>
								<input type="text" class="form-control" name="phone" placeholder=""  style="color:#000!important">		
							</li>

							<li class="col-sm-12" id="pass_li" >
								<label>Password</label>
								<input type="password" class="form-control" name="pass" placeholder="" style="color:#000!important">
							</li>

							<li class="col-sm-12 text-left">
								<button type="submit" class="btn-round">Register</button>
								<a href="<?=base_url().'account/login'?>" class="text-info" style="margin-left:75px!important">Already
									Have an account ? Login</a>
							</li>

						</ul>
					</form>
				</div>

			</div>
		</div>
	</section>
	<?php  $this->load->view('inc/footer'); ?>	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function () {

			$("#signup_form").validate({
				rules: {
					fname: {
						required: true,
						maxlength: 30,
					},
					lname: {
						required: true,
						maxlength: 30,
					},
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
						number:true,
						maxlength: 10,
						minlength: 10,
					}
				},
				messages: {
					fname: {
						required: "Please Enter First Name",
						maxlength: "Your First Name Is too long"
					},
					lname: {
						required: "Please Enter Last Name",
						maxlength: "The Last name is too long"
					},
					phone: {
						required: "Please Enter Phone Number",
						number:"Please enter Valid Phone Number",
					},
					email: {
						required: "Please Enter a Email",
						email: "Please Enter Valid Email"
					},
					
					pass: {
						required: "Please Enter a Password.",
						minlength: "Your password must be contains at least 6 chars",
						maxlength: "Your password is too long"
					}
				},
			})


			var isFirstRequest = true;
			$("#signup_form").submit(function (e) {
				if ($(this).valid()) {
					if (isFirstRequest == true) {
						isFirstRequest = false;
						e.preventDefault();
						const frmData = new FormData(this);
						$.ajax({
							url: "<?= base_url().'account/signup_process' ?>",
							type: "POST",
							dataType: "json",
							data: frmData,
							contentType: false,
							processData: false,
							success: function (response) {
								isFirstRequest = true;
								if (response.success == 1) {
									var element = '<label class="error" for="email">This field is required.</label>';
									$("#signup_form")[0].reset();
									setTimeout(() => {
										Swal.fire(
											'Successfully SignedUP!',
											'Now you can login!',
											'success'
										)
									})
								}
								if (response.error == 1 && response.errorCode == 101) {
									// $("#fname_li").append($(".error").html(response.data.fname))
									// $("#lname_li").append($(".error").html(response.data.lname))
									// $("#email_li").append($(".error").html(response.data.email))
									// $("#pass_li").append($(".error").html(response.data.pass))
									// $("#phone_li").append($(".error").html(response.data.phone))
								}
							},
							onError: function (err) {
								console.log(err);
							}
						})
					}
				}
			})
		})
	</script>
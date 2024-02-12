<div id="wrap" class="layout-1">

	<!-- Top bar -->
	<div class="top-bar">
		<div class="container">
			<p>Welcome to SmartTech center!</p>
			<div class="right-sec">
				<ul>
					<?php
					if($this->session->has_userdata('sessUserId')){ ?>
						<li>
							<a href="<?=base_url().'account'?>">
								<?=	$this->session->userdata("sessUserFname")	?>
							</a>
						</li>

					<?php }else{?>
					<li><a href="<?=base_url().'account/login'?>">Login/</a><a href="<?=base_url().'account/register'?>">Register
						</a></li>
					<?php }	?>

					<li><a href="#.">Store Location </a></li>
					<li><a href="#.">FAQ </a></li>
					<?php 
					if($this->session->has_userdata('sessUserId')){?>
					<li><a href="" id="logout_btn">Logout </a></li>
					<?php }?>

				</ul>
				<div class="social-top"> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i
							class="fa fa-twitter"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> <a href="#."><i
							class="fa fa-dribbble"></i></a> <a href="#."><i class="fa fa-pinterest"></i></a> </div>
			</div>
		</div>
	</div>
<!-- Clients img -->
<section class="light-gry-bg clients-img">
	<div class="container">
		<ul>
			<li><img src="<?= base_url() . 'assets/front/img/theme/c-img-1.png' ?>" alt=""></li>
			<li><img src="<?= base_url() . 'assets/front/img/theme/c-img-2.png' ?>" alt=""></li>
			<li><img src="<?= base_url() . 'assets/front/img/theme/c-img-3.png' ?>" alt=""></li>
			<li><img src="<?= base_url() . 'assets/front/img/theme/c-img-4.png' ?>" alt=""></li>
			<li><img src="<?= base_url() . 'assets/front/img/theme/c-img-5.png' ?>" alt=""></li>
		</ul>
	</div>
</section>



<!-- Newslatter -->
<section class="newslatter">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>Subscribe our Newsletter <span>Get <strong>25% Off</strong> first purchase!</span></h3>
			</div>
			<div class="col-md-6">
				<form>
					<input type="email" placeholder="Your email address here...">
					<button type="submit">Subscribe!</button>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- End Content -->

<!-- Footer -->
<footer>
	<div class="container">

		<!-- Footer Upside Links -->
		<div class="foot-link">
			<ul>
				<li><a href="#."> About us </a></li>
				<li><a href="#."> Customer Service </a></li>
				<li><a href="#."> Privacy Policy </a></li>
				<li><a href="#."> Site Map </a></li>
				<li><a href="#."> Search Terms </a></li>
				<li><a href="#."> Advanced Search </a></li>
				<li><a href="#."> Orders and Returns </a></li>
				<li><a href="#."> Contact Us</a></li>
			</ul>
		</div>
		<div class="row">

			<!-- Contact -->
			<div class="col-md-4">
				<h4>Contact SmartTech!</h4>
				<p>Address: 45 Grand Central Terminal New York, NY 1017
					United State USA</p>
				<p>Phone: (+100) 123 456 7890</p>
				<p>Email: Support@smarttech.com</p>
				<div class="social-links"> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i class="fa fa-twitter"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> <a href="#."><i class="fa fa-pinterest"></i></a> <a href="#."><i class="fa fa-instagram"></i></a> <a href="#."><i class="fa fa-google"></i></a> </div>
			</div>

			<!-- Categories -->
			<div class="col-md-3">
				<h4>Categories</h4>
				<ul class="links-footer">
					<li><a href="#.">Home Audio & Theater</a></li>
					<li><a href="#."> TV & Video</a></li>
					<li><a href="#."> Camera, Photo & Video</a></li>
					<li><a href="#."> Cell Phones & Accessories</a></li>
					<li><a href="#."> Headphones</a></li>
					<li><a href="#."> Video Games</a></li>
					<li><a href="#."> Bluetooth & Wireless</a></li>
				</ul>
			</div>

			<!-- Categories -->
			<div class="col-md-3">
				<h4>Customer Services</h4>
				<ul class="links-footer">
					<li><a href="#.">Shipping & Returns</a></li>
					<li><a href="#."> Secure Shopping</a></li>
					<li><a href="#."> International Shipping</a></li>
					<li><a href="#."> Affiliates</a></li>
					<li><a href="#."> Contact </a></li>
				</ul>
			</div>

			<!-- Categories -->
			<div class="col-md-2">
				<h4>Information</h4>
				<ul class="links-footer">
					<li><a href="#.">Our Blog</a></li>
					<li><a href="#."> About Our Shop</a></li>
					<li><a href="#."> Secure Shopping</a></li>
					<li><a href="#."> Delivery infomation</a></li>
					<li><a href="#."> Store Locations</a></li>
					<li><a href="#."> FAQs</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<!-- Rights -->
<div class="rights">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<p>Copyright © 2017 <a href="#." class="ri-li"> SmartTech </a>HTML5 template. All rights reserved</p>
			</div>
			<div class="col-sm-6 text-right"> <img src="<?= base_url() . 'assets/front/img/theme/card-icon.png' ?>" alt=""> </div>
		</div>
	</div>
</div>

<!-- End Footer -->

</div>
<script src="<?= base_url() . 'assets/front/js/theme/jquery.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/wow.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/bootstrap.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/own-menu.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/jquery.sticky.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/owl.carousel.min.js' ?>"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="<?= base_url() . 'assets/front/js/theme/jquery.tp.t.min.js' ?>"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/front/js/theme/jquery.tp.min.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/js/theme/main.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/plugins/jquery_validation/validation.js' ?>"></script>
<script src="<?= base_url() . 'assets/front/plugins/sweetAlert/sweetAlert.js' ?>"></script>

<script>
	$(document).ready(function() {
		$("#logout_btn").click(function(e) {
			e.preventDefault();
			$.ajax({
				url: "<?= base_url() . 'account/process_logout' ?>",
				type: "POST",
				dataType: "json",
				success: function(response) {
					if (response.success == 1) {
						location.reload()
					}
				},
				error: function(err) {
					console.log(err);
				}
			})
		})

		//Add to cart

		$(document).off('click', '.addToCart')
		$(document).on('click', '.addToCart', function(e) {

			e.preventDefault();
			let product_id = parseInt($(this).parent().parent().attr('data-pro-id'));
			let product_div = $(this).closest('div')
			let product_price = product_div.find('.productPriceDiv').text().trim().replace(/\$|\.00/g, '');
			let ProductData = {
				product_id: product_id,
				product_price: product_price,
				qty: 1,
				total_amount: product_price,
			}
			$.ajax({
				url: "<?= base_url() . 'cart/save' ?>",
				type: "POST",
				dataType: "json",
				data: ProductData,
				success: function(jsonResponse) {
					if (jsonResponse.error == 1) {
						if (jsonResponse.errorCode == 101) {
							location.href = "<?= base_url() . 'account/login' ?>"
						} else if (jsonResponse.errorCode == 505) {
							setTimeout(() => {
								Swal.fire(
									'Product Already added to your cart! 🛒',
									'check your cart',
									'info',
								)
							})
						} else if (jsonResponse.errorCode == 909) {
							location.href = "<?= base_url() . 'account/login' ?>"
						} else {
							setTimeout(() => {
								Swal.fire(
									"Oops! Product could not be added to your cart. ",
									'Please try again later or contact support for assistance.',
									'info'
								)
							})
						}
					}
					if (jsonResponse.success == 1) {
						setTimeout(() => {
							Swal.fire({
								title: 'Product successfully added to your cart! 🛒',
								text: 'Success.',
								icon: 'success',
								showCancelButton: true,
								confirmButtonText: 'Buy Now',
								cancelButtonText: 'Ok',
								buttonsStyling: false,
								customClass: {
									confirmButton: 'swal-buyNowBtn',
									cancelButton: 'swal-okBtn'
								},
								preConfirm: () => {
									window.location.href = '<?= base_url() . 'cart' ?>';
								}
							})

						})
					}
				},
				error: function(jsonResponse) {

					setTimeout(() => {
						Swal.fire(
							"Oops! Product could not be added to your cart. ",
							'Please try again later or contact support for assistance.',
							'info'
						)
					})
				}
			})
		})


	})
</script>
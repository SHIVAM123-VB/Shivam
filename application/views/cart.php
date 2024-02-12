<?php $this->load->view('inc/head', array("pageData" => $pageData)) ?>
<?php $this->load->view('inc/top_header') ?>
<?php $this->load->view('inc/header'); ?>
<div id="content" class="parent_container">
	<!-- Ship Process -->
	<div class="ship-process padding-top-30 padding-bottom-30">
		<div class="container">
			<ul class="row">

				<!-- Step 1 -->
				<li class="col-sm-3 current cart_li cart_btn common_li">
					<div class="media-left"> <i class="flaticon-shopping"></i> </div>
					<div class="media-body"> <span>Step 1</span>
						<h6>Shopping Cart</h6>
					</div>
				</li>

				<!-- Step 2 -->
				<li class="col-sm-3 payment_method_li payment_btn common_li">
					<div class="media-left"> <i class="flaticon-business"></i> </div>
					<div class="media-body"> <span>Step 2</span>
						<h6>Payment Methods</h6>
					</div>
				</li>

				<!-- Step 3 -->
				<li class="col-sm-3 delivery_method_li delivery_btn common_li">
					<div class="media-left"> <i class="flaticon-delivery-truck"></i> </div>
					<div class="media-body"> <span>Step 3</span>
						<h6>Delivery Methods</h6>
					</div>
				</li>

				<!-- Step 4 -->
				<li class="col-sm-3 confirmation_li confirmation_btn common_li">
					<div class="media-left"> <i class="fa fa-check"></i> </div>
					<div class="media-body"> <span>Step 4</span>
						<h6>Confirmation</h6>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<!-- Shopping Cart -->
	<section class="shopping-cart shopping-cart-section padding-bottom-60">
		<div class="container">
			<table class="table">
				<thead>
					<tr>
						<th>Items</th>
						<th class="text-center">Price</th>
						<th class="text-center">Quantity</th>
						<th class="text-center">Total Price </th>
						<th>&nbsp; </th>
					</tr>
				</thead>
				<tbody class="table_body">
					<!-- Item Cart -->
					<?php
					if (isset($pageData['data']['products'])) {
						foreach ($pageData['data']['products'] as  $product) { ?>
							<tr data-index="<?= $product['cart_id'] ?>" class="product_row">
								<td>
									<div class="media">
										<div class="media-left"> <a href="#."> <img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . $product['img'], 600, 600) ?>" alt=""> </a> </div>
										<div class="media-body">
											<p class="pro_name"><?= $product['name'] ?></p>
										</div>
									</div>
								</td>
								<td class="text-center padding-top-60 pro_price"><?= '$' . $product['product_price'] ?></td>
								<td class="text-center">
									<div class="quinty padding-top-20">
										<input type="number" value="<?= $product['qty'] ?>" name="quantity[]" data-name="" data-price="" data-total_amount="" min="1">
									</div>
								</td>
								<td class="text-center padding-top-60 total_price"><?= '$' . $product['total_amount'] ?></td>
								<td class="text-center padding-top-60 remove_item" data-pro-id="<?= $product['product_id'] ?>"><a href="#." class="remove"><i class="fa fa-close"></i></a></td>
							</tr>
					<?php }
					}
					?>

				</tbody>
			</table>

			<!-- Promotion -->
			<div class="promo ">
				<div class="coupen promotion_Code">
					<label> Promotion Code
						<input type="text" placeholder="Your code here">
						<button type="submit"><i class="fa fa-arrow-circle-right"></i></button>
					</label>
				</div>

				<!-- Grand total -->
				<div class="g-totel">
					<h5 class="">Grand total: <span class="grand_total"></span></h5>
				</div>
			</div>

			<!-- Button -->
			<div class="pro-btn"> <a href="<?= base_url() ?>" class="btn-round btn-light">Continue Shopping</a> <button class="payment_btn btn-round">Go Payment Methods</button> </div>
		</div>
	</section>


	<!-- Payment Methods  -->
	<section class="payment_section padding-bottom-60">
		<div class="container">
			<!-- Payout Method -->
			<div class="pay-method">
				<div class="row">
					<div class="col-md-6">

						<!-- Your Card -->
						<div class="heading">
							<h2>Your Card</h2>
							<hr>
						</div>
						<img src="<?= base_url() . 'assets/front/img/theme/card-icon.png' ?>" alt="">
					</div>
					<div class="col-md-6">

						<!-- Your information -->
						<div class="heading">
							<h2>Your information</h2>
							<hr>
						</div>
						<h4>Cash On Delivery</h4>
					</div>
				</div>
			</div>
			<div class="pro-btn p-2"> <button type="button" class="btn-round btn-light back_cart_btn">Back to Shopping Cart</a> <button type="button" class="btn-round delivery_btn">Go Delivery Methods</button></div>
		</div>
	</section>

	<!-- Delivery Methods  -->

	<section class="padding-bottom-60 delivery_section">
		<div class="container">

			<div class="pay-method">
				<div class="row">
					<div class="col-md-6">

						<!-- Your information -->
						<div class="heading row">
							<h2 class="col-md-6">Your information</h2> <span class="col-md-6 error_message"></span>
							<hr>
						</div>
						<form>
							<div class="row">

								<!-- Name -->
								<div class="col-sm-6">
									<label> First name
										<input class="form-control form_credentials fname" type="text" value="<?= $this->session->userdata('sessUserFname') ?>">
									</label>
								</div>

								<!-- Number -->
								<div class="col-sm-6">
									<label> Last Name
										<input class="form-control form_credentials lname" type="text" value="<?= $this->session->userdata('sessUserLname') ?>">
									</label>
								</div>

								<!-- Card Number -->
								<div class="col-sm-7">
									<div class="row">
										<div class="col-sm-5">
											<label>Country
												<input class="form-control form_credentials country" type="text">
											</label>
										</div>
										<div class="col-sm-5">
											<label> City
												<input class="form-control form_credentials city" type="text">
											</label>
										</div>
									</div>
								</div>
								<div class="col-sm-5">
									<label> State
										<input class="form-control form_credentials state" type="text">
									</label>
								</div>

								<!-- Zip code -->
								<div class="col-sm-4">
									<label> Zip code
										<input class="form-control form_credentials zip_code" type="text">
									</label>
								</div>

								<!-- Address -->
								<div class="col-sm-8">
									<label> Address
										<input class="form-control form_credentials address" type="text">
									</label>
								</div>

								<!-- Phone -->
								<div class="col-sm-6">
									<label> Phone
										<input class="form-control form_credentials mobile_number" type="text" value="<?= $this->session->userdata('sessUserPhone') ?>">
									</label>
								</div>

								<!-- Number -->
								<div class="col-sm-6">
									<label> Email
										<input class="form-control form_credentials email" type="email" value="<?= $this->session->userdata('sessUserEmail') ?>">
									</label>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Button -->
			<div class="pro-btn"> <button type="button" class="btn-round btn-light back_payment_btn">Back to Payment</button> <button type="button" class="btn-round confirmation_btn">Go Confirmation</a> </div>
		</div>
	</section>


	<!-- Confirmation -->

	<section class="padding-bottom-60 confirmation_section">

		<div class="container">
			<!-- Payout Method -->
			<div class="pay-method check-out">

				<!-- Shopping Cart -->
				<div class="heading">
					<h2>Shopping Cart</h2>
					<hr>
				</div>


				<!-- Check Item List -->
				<?php if (isset($pageData['data']['cartDetails'])) {
					foreach ($pageData['data']['products'] as $cartProduct) {
				?>
						<ul class="row check-item confirmation_ul" data-index="<?= $cartProduct['cart_id'] ?>" data-product-id="<?= $cartProduct['product_id'] ?>">
							<li class="col-xs-6">
								<p class="productName" data-index="<?= $cartProduct['cart_id'] ?>"><?= $cartProduct['name'] ?></p>
							</li>
							<li class="col-xs-2 text-center">
								<p class="productPrice" data-index="<?= $cartProduct['cart_id'] ?>"><?= '$' . $cartProduct['product_price'] . '.00' ?></p>
							</li>
							<li class="col-xs-2 text-center">
								<p class="product_qty" data-index="<?= $cartProduct['cart_id'] ?>"><?= $cartProduct['qty'] ?></p>
							</li>
							<li class="col-xs-2 text-center">
								<p class="confirm_total_amount" data-index="<?= $cartProduct['cart_id'] ?>"><?= '$' . $cartProduct['total_amount'] . '.00' ?></p>
							</li>
						</ul>
				<?php }
				}
				?>


				<!-- Payment information -->
				<div class="heading margin-top-50">
					<h2>Payment information</h2>
					<hr>
				</div>
				<!-- Check Item List -->
				<ul class="row check-item">
					<h5>Cash On Delivery</h5>
				</ul>

				<!-- Delivery infomation -->
				<div class="heading margin-top-50">
					<h2>Delivery infomation</h2>
					<hr>
				</div>

				<!-- Information -->
				<ul class="row check-item infoma">
					<li class="col-sm-3">
						<h6>Name</h6>
						<span class="user_name">Alex Adkins</span>
					</li>
					<li class="col-sm-3">
						<h6>Phone</h6>
						<span class="user_number">(+100) 987 654 3210</span>
					</li>
					<li class="col-sm-3">
						<h6>Country</h6>
						<span class="user_country">USA</span>
					</li>
					<li class="col-sm-3">
						<h6>Email</h6>
						<span class="user_email">Alexadkins@gmail.com</span>
					</li>
					<li class="col-sm-3">
						<h6>City</h6>
						<span class="user_city">NewYork</span>
					</li>
					<li class="col-sm-3">
						<h6>State</h6>
						<span class="user_state">NewYork</span>
					</li>
					<li class="col-sm-3">
						<h6>Zipcode</h6>
						<span class="user_zipCode">01234</span>
					</li>
					<li class="col-sm-3">
						<h6>Address</h6>
						<span class="user_address">569 Lexington Ave, New York, NY</span>
					</li>
				</ul>
				<!-- Information -->
				<ul></ul>
				<!-- Totel Price -->
				<div class="totel-price">
					<h4><small> Total Price: </small><span class="grand_total grand-total-price"></span></h4>
				</div>
			</div>

			<!-- Button -->
			<div class="pro-btn"> <button type="button" class="btn-round btn-light back_delivery_btn">Back to Delivery</button> <button type="button" class="btn-round checkout_btn">Proceed to Checkout</a> </div>
		</div>
	</section>


</div>
<?php $this->load->view('inc/footer.php'); ?>
<script>
	jQuery(document).ready(function() {

		// Top Scrolling
		let topScrolling = () =>{
			$('html, body').animate({scrollTop: 0}, 'slow');
		}
		topScrolling();

		//By default hiding sections 
		$('.payment_section,.promotion_Code,.delivery_section,.confirmation_section').hide()

		// checking the products count
		<?php if (count($pageData['data']['cartDetails']) <= 0) { ?>
			$('.parent_container').html("<h1 class='text-center m-5 padding-bottom-100'>No Products Found</h1>");
		<?php } ?>
		// Calculating the total

		$(document).on('input', 'input[name="quantity[]"]', function() {
			let qty = $(this).val();
			let closestTr = $(this).closest('tr');
			let extractedText = closestTr.find('.pro_price').text().trim();
			let price = parseFloat(extractedText.replace(/\$|\.00/g, ''));
			let total = parseInt(price * qty)
			let name = closestTr.find('.pro_name').text();
			let cartId = closestTr.data('index');
			var min = parseInt($(this).attr('min'));
			if (parseInt($(this).val()) < min) {
				$(this).val(min);
			}
			if ($('ul.confirmation_ul[data-index="' + cartId + '"]').length > 0) {
				$('.productName[data-index="' + cartId + '"]').text(name);
				$('.productPrice[data-index="' + cartId + '"]').text('$' + price + '.00');
				$('.product_qty[data-index="' + cartId + '"]').text(qty);
				$('.confirm_total_amount[data-index="' + cartId + '"]').text('$' + total + '.00');
			}

			// calculating Grand Total
			if (!isNaN(price)) {
				closestTr.find('.total_price').text("$" + total)
				let allTrPrices = $('tr .total_price').map(function() {
					let priceText = $(this).text().trim().replace(/\$|\.00/g, '');
					return parseFloat(priceText);
				}).get();
				if (allTrPrices.length > 0) {
					let totalPrice = allTrPrices.reduce((accumulator, currentValue) => accumulator + currentValue);
					$('.grand_total').text('$' + totalPrice + ".00")
				}
			} else {
				console.log("Invalid Price. Could not parse a number.");
			}
		});

		//Grand total
		let allTrPrices = $('tr .total_price').map(function() {
			let priceText = $(this).text().trim().replace(/\$|\.00/g, '');
			return parseFloat(priceText);
		}).get();
		if (allTrPrices.length > 0) {
			let totalPrice = allTrPrices.reduce((accumulator, currentValue) => accumulator + currentValue);
			$('.grand_total').text('$' + totalPrice + ".00")
		}

		// Remove Product
		$('.remove_item').click(function(e) {
			let product_id = $(this).data('pro-id')
			let cartId = $(this).closest('.product_row').data('index');
			e.preventDefault();
			Swal.fire({
				title: 'Remove Product',
				text: 'Do you want to remove the product?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No'
			}).then((result) => {

				if (result.isConfirmed) {
					$.ajax({
						url: "<?= base_url() . 'cart/save' ?>",
						type: "POST",
						dataType: "json",
						data: {
							product_id
						},
						success: function(jsonResponse) {
							if (jsonResponse.success == 1) {
								let removePro = $('.product_row[data-index = "' + cartId + '"],.confirmation_ul[data-index = "' + cartId + '"]').remove();
								if (removePro) {
									if ($('tbody').children().length == 0) {
										$('.parent_container').html("<h1 class='text-center m-5 padding-bottom-100'>No Products Found</h1>");
									}
								}
								let allTrPrices = $('tr .total_price').map(function() {
									let priceText = $(this).text().trim().replace(/\$|\.00/g, '');
									return parseFloat(priceText);
								}).get();
								if (allTrPrices.length > 0) {
									let totalPrice = allTrPrices.reduce((accumulator, currentValue) => accumulator + currentValue);
									$('.grand_total').text('$' + totalPrice + ".00")
								}
							} else {
								setTimeout(() => {
									Swal.fire(
										"Oops! Product couldn't be removed. ",
										'Please try again later or contact support for assistance.',
										'error'
									)
								})
							}
						},
						error: function(jsonResponse) {
							setTimeout(() => {
								Swal.fire(
									"Oops! Product couldn't be removed. ",
									'Please try again later or contact support for assistance.',
									'error'
								)
							})
						}
					})
				}
			});
		})



		// payment method ajax
		$(document).off('click', ".back_cart_btn")
		$(document).on('click', ".back_cart_btn,.cart_btn", function(e) {
			e.preventDefault();
			$('.delivery_section,.payment_section,.confirmation_section').hide()
			$('.shopping-cart-section').show('slow');
			$('.payment_method_li,.delivery_method_li,.confirmation_li').removeClass('current');
			$('.cart_li').addClass('current');
			topScrolling();
			check();
		})

		$(document).off('click', ".payment_btn,.back_payment_btn")
		$(document).on('click', ".payment_btn,.back_payment_btn", function(e) {
			<?php if (count($pageData['data']['cartDetails']) > 0) { ?>
				e.preventDefault();
				$('.delivery_section,.shopping-cart-section,.confirmation_section').hide();
				$('.payment_section').show('slow');
				$('.delivery_method_li,.cart_li,.confirmation_li').removeClass('current');
				$('.payment_method_li').addClass('current');
				topScrolling();
			<?php }  ?>
			check();
		})

		// delivery method 
		$(document).off('click', ".delivery_btn,.back_delivery_btn")
		$(document).on('click', ".delivery_btn,.back_delivery_btn", function(e) {
			e.preventDefault();
			$('.confirmation_section,.shopping-cart-section,.payment_section').hide()
			$('.delivery_section').show('slow')
			$('.payment_method_li,.cart_li,.confirmation_li').removeClass('current');
			$('.delivery_method_li').addClass('current');
			topScrolling();
			check();
		})

		// confirmation 
		$(document).off('click', ".confirmation_btn")
		$(document).on('click', ".confirmation_btn", function(e) {

			e.preventDefault();
			var allFieldsAreFilled = (
				$('.fname').val() !== '' &&
				$('.lname').val() !== '' &&
				$('.email').val() !== '' &&
				$('.mobile_number').val() !== '' &&
				$('.city').val() !== '' &&
				$('.state').val() !== '' &&
				$('.country').val() !== '' &&
				$('.zip_code').val() !== '' &&
				$('.address').val() !== ''
			);
			if (allFieldsAreFilled) {
				$('.delivery_section,.shopping-cart-section,.payment_section').hide()
				$('.confirmation_section').show('slow')
				$('.payment_method_li,.cart_li,.delivery_method_li').removeClass('current');
				$('.confirmation_li').addClass('current');
				$('.user_email').text($('.email').val())
				$('.user_number').text($('.mobile_number').val())
				$('.user_name').text($('.fname').val() + ' ' + $('.lname').val())
				$('.user_city').text($('.city').val())
				$('.user_state').text($('.state').val())
				$('.user_country').text($('.country').val())
				$('.user_zipCode').text($('.zip_code').val())
				$('.user_address').text($('.address').val())
				topScrolling();	
				check();
			} else {
				setTimeout(() => {
					Swal.fire(
						"Please fill out all the fields.",
						'Please try again later or contact support for assistance.',
						'error'
					)
				})
			}
		})

		// condition check function 
		let checkPage = false;
		let check = () => {
			if ($('.cart_li').hasClass('current')) {
				if (checkPage == false) {
					$('.common_li').removeClass('delivery_btn confirmation_btn');
					$('.payment_method_li').addClass('payment_btn');
				}
			} else if ($('.payment_method_li').hasClass('current')) {
				if (checkPage == false) {
					$('.delivery_method_li').addClass('delivery_btn');
					$('.cart_li').addClass('cart_btn');
					$('.common_li').removeClass('confirmation_btn');
				}
			} else if ($('.delivery_method_li').hasClass('current')) {
				if (checkPage == false) {
					$('.confirmation_li').addClass('confirmation_btn');
					$('.payment_method_li').addClass('payment_btn');
				}
			} else if ($('.confirmation_li').hasClass('current')) {
				checkPage = true;
				$('.delivery_method_li').addClass('delivery_btn');
				$('.payment_method_li').addClass('payment_btn');
				$('.cart_li').addClass('cart_btn');
			}
		}
		check();


		// Order Placing ajax
		$('.checkout_btn').click((e) => {
			e.preventDefault();
			Swal.fire({
				title: 'Confirm order',
				text: 'Do you want to purchase the product',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.isConfirmed) {
					const products = [];
					$('.confirmation_ul').each(function() {
						var rowData = {
							product_id: parseInt($(this).attr('data-product-id')),
							qty: $(this).find('.product_qty').text(),
						}
						products.push(rowData);
					});
					const frmData = {
						user_address: $('.user_address').text(),
						user_city: $('.user_city').text(),
						user_state: $('.user_state').text(),
						user_country: $('.user_country').text(),
						user_zipCode: $('.user_zipCode').text(),
						products: products
					}

					$.ajax({
						url: "<?= base_url() . 'orders/save' ?>",
						type: "POST",
						dataType: "json",
						data: frmData,
						success: function(jsonResponse) {
							if (jsonResponse.success == 1) {
								setTimeout(() => {
									Swal.fire({
										title: "Order Placed.",
										text: "Thank you for your purchase!",
										icon: "success",
										showCancelButton: false,
										confirmButtonText: "OK"
									}).then((result) => {
										if (result.isConfirmed) {
											window.location.href = "<?=base_url().'orders'?>";
										}else{
											window.location.href = "<?=base_url().'orders'?>";
										}
									});
								})
							}
							if (jsonResponse.error == 1) {
								if (jsonResponse.errorCode == 101 || jsonResponse.errorCode == 106) {
									setTimeout(() => {
										Swal.fire(
											"Oops! Order could not be placed. ",
											'Please try again later or contact support for assistance.',
											'info'
										)
									})
								}
								if (jsonResponse.errorCode == 102) {
									setTimeout(() => {
										Swal.fire(
											"Something went wrong. ",
											'Please try again later or contact support for assistance.',
											'error'
										)
									})
								}
								if (jsonResponse.errorCode == 105) {
									if (jsonResponse.data.user_address) {
										setTimeout(() => {
											Swal.fire(
												"Please enter valid address. ",
												'try to write valid address.',
												'error'
											)
										})
									} else if (jsonResponse.data.user_city) {
											setTimeout(() => {
												Swal.fire(
													"Please enter city name. ",
													'try to write city name.',
													'error'
												)
											})
									} else if (jsonResponse.data.user_state) {
											setTimeout(() => {
												Swal.fire(
													"Please enter state name. ",
													'try to write state name.',
													'error'
												)
											})
									} else if (jsonResponse.data.user_country) {
											setTimeout(() => {
												Swal.fire(
													"Please enter country name. ",
													'try to write country name.',
													'error'
												)
											})
									} else {
											setTimeout(() => {
												Swal.fire(
													"Please enter valid Zipcode. ",
													'try to write valid Zipcode.',
													'error'
												)
											})
									}
								}
								if (jsonResponse.errorCode == 104) {
									setTimeout(() => {
										Swal.fire(
											"Product not found. ",
											'Try again later.',
											'info'
										)
									})
								}
								if (jsonResponse.errorCode == 103) {
									setTimeout(() => {
										Swal.fire(
											"The product is currently out of stock.",
											'try again later.',
											'info'
										)
									})
								}
							}
						},
						error: function(jsonResponse) {
							setTimeout(() => {
								Swal.fire(
									"Oops!Some thing went wrong. ",
									'Please try again later or contact support for assistance.',
									'error'
								)
							})
						}
					})
				}
			})
		})


	})
</script>
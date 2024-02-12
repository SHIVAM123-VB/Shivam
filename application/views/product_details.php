<?php $this->load->view('inc/head', array("pageData" => $pageData)) ?>
<?php $this->load->view('inc/top_header') ?>
<?php $this->load->view('inc/header'); ?>

<body>

	<!-- Page Wrapper -->
	<div id="wrap">

		<!-- Top bar -->


		<!-- Content -->
		<div id="content">

			<!-- Products -->
			<section class="padding-top-40 padding-bottom-60">
				<div class="container">
					<div class="row">

						<!-- Shop Side Bar -->
						<div class="col-md-3">
							<div class="shop-side-bar">

								<!-- Categories -->
								<h6>Categories</h6>
								<div class="checkbox checkbox-primary">
									<ul>
										<?php foreach ($pageData['data']['categories'] as $category) { ?>
											<li>
												<input class="styled" type="checkbox">
												<label><?= $category['name'] ?></label>
											</li>
										<?php } ?>
									</ul>
								</div>

								<!-- Categories -->
								<h6>Price</h6>
								<!-- PRICE -->
								<div class="cost-price-content">
									<div id="price-range" class="price-range"></div>
									<span id="price-min" class="price-min">20</span> <span id="price-max" class="price-max">80</span> <a href="#." class="btn-round filter_btn">Filter</a>
								</div>

								<!-- Featured Brands -->
								<h6>Featured Brands</h6>
								<div class="checkbox checkbox-primary">
									<ul>
										<li>
											<input id="brand1" class="styled" type="checkbox">
											<label for="brand1"> Apple <span>(217)</span> </label>
										</li>
										<li>
											<input id="brand2" class="styled" type="checkbox">
											<label for="brand2"> Acer <span>(79)</span> </label>
										</li>
										<li>
											<input id="brand3" class="styled" type="checkbox">
											<label for="brand3"> Asus <span>(283)</span> </label>
										</li>
										<li>
											<input id="brand4" class="styled" type="checkbox">
											<label for="brand4">Samsung <span>(116)</span> </label>
										</li>
										<li>
											<input id="brand5" class="styled" type="checkbox">
											<label for="brand5"> LG <span>(29)</span> </label>
										</li>
										<li>
											<input id="brand6" class="styled" type="checkbox">
											<label for="brand6"> Electrolux <span>(179)</span> </label>
										</li>
										<li>
											<input id="brand7" class="styled" type="checkbox">
											<label for="brand7"> Toshiba <span>(38)</span> </label>
										</li>
										<li>
											<input id="brand8" class="styled" type="checkbox">
											<label for="brand8"> Sharp <span>(205)</span> </label>
										</li>
										<li>
											<input id="brand9" class="styled" type="checkbox">
											<label for="brand9"> Sony <span>(35)</span> </label>
										</li>
									</ul>
								</div>

								<!-- Rating -->
								<h6>Rating</h6>
								<div class="rating">
									<ul>
										<li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> <span>(218)</span></a></li>
										<li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(178)</span></a></li>
										<li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(79)</span></a></li>
										<li><a href="#."><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span>(188)</span></a></li>
									</ul>
								</div>


								<!-- Colors -->
								<h6>Size</h6>
								<div class="sizes"> <a href="#.">S</a> <a href="#.">M</a> <a href="#.">L</a> <a href="#.">XL</a> </div>

								<!-- Colors -->
								<h6>Colors</h6>
								<div class="checkbox checkbox-primary">
									<ul>
										<li>
											<input id="colr1" class="styled" type="checkbox">
											<label for="colr1"> Red <span>(217)</span> </label>
										</li>
										<li>
											<input id="colr2" class="styled" type="checkbox">
											<label for="colr2"> Yellow <span> (179) </span> </label>
										</li>
										<li>
											<input id="colr3" class="styled" type="checkbox">
											<label for="colr3"> Black <span>(79)</span> </label>
										</li>
										<li>
											<input id="colr4" class="styled" type="checkbox">
											<label for="colr4">Blue <span>(283) </span></label>
										</li>
										<li>
											<input id="colr5" class="styled" type="checkbox">
											<label for="colr5"> Grey <span> (116)</span> </label>
										</li>
										<li>
											<input id="colr6" class="styled" type="checkbox">
											<label for="colr6"> Pink<span> (29) </span></label>
										</li>
										<li>
											<input id="colr7" class="styled" type="checkbox">
											<label for="colr7"> White <span> (38)</span> </label>
										</li>
										<li>
											<input id="colr8" class="styled" type="checkbox">
											<label for="colr8">Green <span>(205)</span></label>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Products -->
						<div class="col-md-9">
							<div class="product-detail">
								<div class="product">
									<div class="row">
										<!-- Slider Thumb -->
										<!-- Slider Thumb -->
										<div class="col-xs-5">
											<article class="slider-item on-nav">
												<div class="thumb-slider">
													<ul class="slides">

														<li data-thumb="images/item-img-1-1.jpg"> <img src="<?= getImage(base_url() . 'data/product_images/' . $pageData['data']['products']['img'], 600, 600); ?>" alt=""> </li>

													</ul>


												</div>
											</article>
										</div>

										<!-- Item Content -->
										<div class="col-xs-7"> <span class="tags"><?= $pageData['data']['products']['category'] ?></span>
											<h5><?= $pageData['data']['products']['name'] ?></h5>
											<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>
											<div class="row">
												<div class="col-sm-6"><span class="price"><?= '$' . $pageData['data']['products']['price'] . '.00' ?> </span></div>
												<div class="col-sm-6">

													<p>Availability: <span class="in-stock"><?= $pageData['data']['products']['availability'] > 0 ? "In Stock" : "Out Of Stock" ?></span></p>
												</div>
											</div>
											<!-- List Details -->
											<ul class="bullet-round-list">
												<?php $pro_desc = explode('<<>>', $pageData['data']['products']['description']) ?>
												<?php foreach ($pro_desc as $desc) { ?>
													<li><?= $desc ?></li>
												<?php } ?>
											</ul>
											<!-- Colors -->
											<div class="row">
												<div class="col-xs-5">
													<div class="clr"> <span style="background:#068bcd"></span> <span style="background:#d4b174"></span> <span style="background:#333333"></span> </div>
												</div>
												<!-- Sizes -->
												<div class="col-xs-7">
													<div class="sizes"> <a href="#.">S</a> <a class="active" href="#.">M</a> <a href="#.">L</a> <a href="#.">XL</a> </div>
												</div>
											</div>

											<!-- Compare Wishlist -->
											<ul class="cmp-list">
												<li><a href="#."><i class="fa fa-heart"></i> Add to Wishlist</a></li>
												<li><a href="#."><i class="fa fa-navicon"></i> Add to Compare</a></li>
												<li><a href="#."><i class="fa fa-envelope"></i> Email to a friend</a></li>
											</ul>
											<!-- Quinty -->
											<div class="quinty">
												<input type="number" value="1" id="qty" min="1">
											</div>
											<a href="" class="btn-round addToCartBtn"><i class="icon-basket-loaded margin-right-5"></i> Add to Cart</a>
										</div>
									</div>
								</div>

								<!-- Details Tab Section-->
								<div class="item-tabs-sec">

									<!-- Nav tabs -->
									<ul class="nav" role="tablist">
										<li role="presentation" class="active"><a href="#pro-detil" role="tab" data-toggle="tab">Product Details</a></li>
										<li role="presentation"><a href="#cus-rev" role="tab" data-toggle="tab">Customer Reviews</a></li>
										<li role="presentation"><a href="#ship" role="tab" data-toggle="tab">Shipping & Payment</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="pro-detil">
											<!-- List Details -->
											<ul class="bullet-round-list">
												<li>Power Smartphone 7s G930F 128GB International version - Silver</li>
												<li> 2G bands: GSM 850 / 900 / 1800 / 1900 3G bands: HSDPA 850 / 900 / 1900 / 2100 4G bands: LTE 700 / 800 / 850<br>
													900 / 1800 / 1900 / 2100 / 2600</li>
												<li> Dimensions: 142.4 x 69.6 x 7.9 mm (5.61 x 2.74 x 0.31 in) Weight 152 g (5.36 oz)</li>
												<li> IP68 certified - dust proof and water resistant over 1.5 meter and 30 minutes</li>
												<li> Internal: 128GB, 4 GB RAM </li>
											</ul>
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Carrier</th>
															<th>Compatibility Rating </th>
															<th>Voice / Text </th>
															<th>Voice / Text </th>
															<th>2G Data </th>
															<th>3G Data </th>
															<th>4G LTE Data </th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>AT&T </td>
															<td>Fully Compatible</td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"></td>
														</tr>
														<tr>
															<td>Sprint </td>
															<td>No Voice/Text and Partial Data Connection</td>
															<td class="text-center"></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
														</tr>
														<tr>
															<td>Q-Mobile </td>
															<td>Partial Data Connection</td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
														</tr>
														<tr>
															<td>Verizon Wireless </td>
															<td>No Votice/Text and Partial Data Connection</td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
															<td class="text-center"><i class="fa fa-check"></i></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="cus-rev"></div>
										<div role="tabpanel" class="tab-pane fade" id="ship"></div>
									</div>
								</div>
							</div>
							<!-- Related Products -->
							<section class="padding-top-30 padding-bottom-0">
								<!-- heading -->
								<div class="heading">
									<h2>Related Products</h2>
									<hr>
								</div>
								<div class="item-slide-4 with-nav" id="relatedProducts">
									<?php $productStr = ''; ?>
									<?php foreach ($pageData['data']['random_products'] as $related_products) {
										$productStr .= '<div class="product related_products" data-index="' . $related_products['category_id'] . '" data-pro-id="$rand_products[id]">';
											$productStr .= '<article>';
												$productStr .= '<a href="'.base_url() . 'product/detail/' . $related_products['id'].'"> <img class="img-responsive" src="' . getImage(base_url() . 'data/product_images/' . trim($related_products['img']), 600, 600) . '" alt=""></a>';
												$productStr .=	'<span class="tag">' . $related_products['category'] . '</span> <a href="'.base_url() . 'product/detail/' . $related_products['id'].'" class="tittle">' . substr($related_products['name'], 0, 45) . '</a>';
												$productStr .=	'<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>';
												$productStr .=	'<div class="price productPrice">$' . $related_products['price'] . '.00 </div>';
												$productStr .= '<button type="button" class="cart-btn addToCart"><i class="icon-basket-loaded"></i></button>';
											$productStr .= '</article>';
										$productStr .= '</div>';
									} ?>
								</div>
							</section>
						</div>

					</div>
				</div>
			</section>

			<!-- Your Recently Viewed Items -->
			<section class="padding-bottom-60">
				<div class="container">

					<!-- heading -->
					<div class="heading">
						<h2>Your Recently Viewed Items</h2>
						<hr>
					</div>
					<!-- Items Slider -->
					<div class="item-slide-5 with-nav">
						<?php foreach ($pageData['data']['random_products'] as $rand_products) { ?>
							<div class="product" data-pro-id="<?=$rand_products['id']?>">
								<article>
									<a href="<?= base_url() . 'product/detail/' . $rand_products['id'] ?>"> <img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . trim($rand_products['img']), 600, 600) ?>" alt=""></a>
									<span class="tag"><?= $rand_products['category'] ?></span> <a href="<?= base_url() . 'product/detail/' . $rand_products['id'] ?>" class="tittle"><?= substr($rand_products['name'], 0, 45) ?></a>
									<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>
									<div class="price productPriceDiv"><?= '$' . $rand_products['price'] . '.00' ?></div>
									<a href="#." class="cart-btn addToCart"><i class="icon-basket-loaded"></i></a>
								</article>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		</div>


		<!-- GO TO TOP  -->
		<a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a>
		<!-- GO TO TOP End -->
	</div>
	<!-- End Page Wrapper -->

	<!-- JavaScripts -->
	<?php $this->load->view('inc/footer.php'); ?>
	<script>
		jQuery(document).ready(function($) {
			//  Price Filter ( noUiSlider Plugin)
			$("#price-range").noUiSlider({
				range: {
					'min': [0],
					'max': [2000]
				},
				start: [40, 940],
				connect: true,
				serialization: {
					lower: [
						$.Link({
							target: $("#price-min")
						})
					],
					upper: [
						$.Link({
							target: $("#price-max")
						})
					],
					format: {
						// Set formatting
						decimals: 2,
						prefix: '$'
					}
				}
			})
		})

		$(".item-slide-5").owlCarousel({
			items: 5,
			autoplay: true,
			loop: false,
			margin: 30,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			navText: ["<i class='fa fa-angle-left left-right-angles'></i>", "<i class='fa fa-angle-right left-right-angles'></i>"],
			lazyLoad: true,
			nav: true,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 3,
				},
				1000: {
					items: 4,
				},
				1200: {
					items: 5,
				}
			},
			animateOut: 'fadeOut'
		});
		// related products carousel
		const related_products_slider_ini = () => {
			$("#relatedProducts").owlCarousel({
				items: 5,
				autoplay: true,
				loop: false,
				margin: 30,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				navText: ["<i class='fa fa-angle-left left-right-angles'></i>", "<i class='fa fa-angle-right left-right-angles'></i>"],
				lazyLoad: true,
				nav: true,
				responsive: {
					0: {
						items: 1,
					},
					600: {
						items: 3,
					},
					1000: {
						items: 4,
					},
					1200: {
						items: 5,
					}
				},
				animateOut: 'fadeOut'
			});
		}

		//Filter Btn 
		$(document).off('click', '.filter_btn')
		$(document).on('click', '.filter_btn', function(e) {
			e.preventDefault();
			let price_min = parseFloat($('.price-min').text().replace(/\$|\.00/g, ''));
			let price_max = parseFloat($('.price-max').text().replace(/\$|\.00/g, ''));
			$('.related_products .productPrice').each(function() {
				let product_price = parseFloat($(this).text().replace(/\$|\.00/g, ''));
				if (!isNaN(product_price) && (product_price < price_min || product_price > price_max)) {
					$(this).closest('.related_products').remove()
					
				}
				related_products_slider_ini();
			});
		});

		// Related products
		let products = '<?= ($productStr) ?>';
		$("#relatedProducts").html(products);

		$('#relatedProducts').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
		var dataIndexArray = [];
		let category_id = '<?= ($pageData['data']['products']['category_id']) ?>';
		let matched_products = ''
		$('.product.related_products').each(function() {
			var dataIndex = $(this).data('index');
			dataIndexArray.push(dataIndex);
			matched_products = $('.related_products').filter(function() {
			return $(this).attr('data-index') === category_id
		})
		})		
		$("#relatedProducts").html(matched_products);
		related_products_slider_ini();



		// Add to Cart 
		$('.addToCartBtn').click(function(e) {
			e.preventDefault();
			let Product_data = {
				product_id: "<?= $pageData['data']['products']['id'] ?>",
				product_price: "<?= $pageData['data']['products']['price'] ?>",
				user_id: "<?= $this->session->userdata('sessUserId') ?>",
				qty: $('#qty').val(),
				total_amount: $('#qty').val() * '<?= $pageData['data']['products']['price'] ?>',
			}
			$.ajax({
				url: "<?= base_url() . 'cart/save' ?>",
				type: "POST",
				dataType: "json",
				data: Product_data,
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
			$('#qty').on('input', function() {
				var min = parseInt($(this).attr('min'));
				if (parseInt($(this).val()) < min) {
					$(this).val(min);
				}
			});


		})
	</script>

</body>
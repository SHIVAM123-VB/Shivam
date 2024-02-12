<?php $this->load->view('inc/head', array("pageData" => $pageData)) ?>
<?php $this->load->view('inc/top_header') ?>
<?php $this->load->view('inc/header'); ?>

<body>


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
											<input class="styled checkbox" type="checkbox" name="cate">
											<label for="cate" class="checkbox-category" data-category-id="<?= $category['id'] ?>"><?= $category['name'] ?></label>
										</li>
									<?php } ?>
								</ul>
							</div>

							<!-- Categories -->
							<h6>Price</h6>
							<!-- PRICE -->
							<div class="cost-price-content">
								<div id="price-range" class="price-range"></div>
								<span id="price-min" class="price-min">1</span> <span id="price-max" class="price-max">10000</span> <button type="button" class="btn-round filter_btn">Filter</a>
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
									<li>
										<input id="brand10" class="styled" type="checkbox">
										<label for="brand10"> HTC <span>(59)</span> </label>
									</li>
									<li>
										<input id="brand11" class="styled" type="checkbox">
										<label for="brand11"> Lenovo <span>(68)</span> </label>
									</li>
									<li>
										<input id="brand12" class="styled" type="checkbox">
										<label for="brand12">Sanyo (19) </label>
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

						<!-- Short List -->
						<div class="short-lst">

							<h2></h2>
							<ul>
								<!-- Short List -->
								<li>
									<p>Showing 1–7 of <?= isset($pageData['data']['searchData']) ? count($pageData['data']['searchData']) : 0 ?></p>
								</li>
								<!-- Short  -->
								<li>
									<select class="selectpicker">
										<option>Show 12 </option>
										<option>Show 24 </option>
										<option>Show 32 </option>
									</select>
								</li>
								<!-- by Default -->
								<li>
									<select class="selectpicker">
										<option>Sort by Default </option>
										<option>Sort by Default </option>
										<option>Sort by Default</option>
									</select>
								</li>

								<!-- Grid Layer -->
								<li class="grid-layer"> <a href="#."><i class="fa fa-list margin-right-10"></i></a> <a href="#."><i class="fa fa-th"></i></a> </li>
							</ul>
						</div>

						<!-- Items -->
						<div class="col-list">
							<div id="searched_products">
							</div>
							<!-- pagination -->
							<div class="pagination">
								<ul>
									<?php echo $this->pagination->create_links(); ?>
								</ul>
							</div>
						</div>
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
						<div class="product" data-pro-id=<?= $rand_products['id'] ?>>
							<article>
								<a href="<?= base_url() . 'product/detail/' . $rand_products['id'] ?>"><img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . trim($rand_products['img']), 600, 600) ?>" alt=""></a>
								<span class="tag"><?= $rand_products['category'] ?></span> <a href="<?= base_url() . 'product/detail/' . $rand_products['id'] ?>" class=""><?= substr($rand_products['name'], 0, 45) ?></a>
								<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>
								<div class="price productPriceDiv"><?= '$' . $rand_products['price'] . '.00' ?></div>
								<button type="button" class="cart-btn addToCart"><i class="icon-basket-loaded"></i></button>
							</article>
						</div>
					<?php }
					?>

				</div>
			</div>
		</section>


	</div>
	<?php $this->load->view('inc/footer.php'); ?>
	<script>
		$(document).ready(function() {
			let all_pro_prices = document.querySelectorAll('.productPrice');
			let pro_prices = Array.from(all_pro_prices).map(priceElement => parseFloat(priceElement.innerHTML.replace(/\$|\.00/g, '')));
			let pro_min_price = Math.min(...pro_prices);
			let pro_max_price = Math.max(...pro_prices);


			// Item Slider
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

			// getting the search products
			let price_min = parseFloat($('.price-min').text().replace(/\$|\.00/g, ''));
			let price_max = parseFloat($('.price-max').text().replace(/\$|\.00/g, ''));
			var url = new URL(window.location.href);
			var keywords = url.searchParams.get("keywords");
			let filter = {
				search: keywords,
				price: `${price_min}:${price_max}`,
				categories: [],
				limit: 7,
				page: 1
			}
			$.ajax({
				url: "<?= base_url() . 'Product/search' ?>",
				type: "POST",
				dataType: "json",
				data: filter,
				success: function(jsonResponse) {
					if (jsonResponse.success == 1 && jsonResponse.data.products.length > 0) {
						let search_pro = '';
						jsonResponse.data.products.map((pro) => {
							search_pro += '<div class="product search_result_products" data-pro-id="' + pro.id + '">';
								search_pro += '<article>';
									search_pro += '<div class="media-left">';
									search_pro += '<div class="item-img">';
										search_pro += '<a href="<?= base_url() . 'product/detail/' ?>' + pro.id + '"><img class="img-responsive" src="	' + pro.img + '" alt=""></a></div>';
									search_pro += '</div>';
									search_pro += '<div class="media-body">';
										search_pro += '<div class="row">';
											search_pro += '<div class="col-sm-7"> <span class="tag">' + pro.category + '</span><a href=""<?= base_url() . 'product/detail/' ?>' + pro.id + '"" class="tittle">' + pro.name + '</a>';
												search_pro += '<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span></p>';
												search_pro += '<ul class="bullet-round-list">';
													let descStr = ''
													for (let i = 0; i < pro.description.length; i++) {
														descStr += '<li>' + pro.description[i] + '</li>';
													}
												search_pro += descStr;
												search_pro += '</ul>';
											search_pro += '</div>';
											search_pro += '<div class="col-sm-5 text-center"> <a href="#." class="heart"><i class="fa fa-heart heart_icon"></i></a> <a href="#." class="heart navi nevi_icon"><i class="fa fa-navicon"></i></a>';
												search_pro += '<div class="position-center-center">';
													search_pro += '<div class="price productPrice">$' + pro.price + '.00</p>';
														search_pro += '<p>Availability: <span class="in-stock">In stock</span></p>';
														search_pro += '<button type="button" class="btn-round addToCartBtn"><i class="icon-basket-loaded"></i> Add to Cart</a>';
													search_pro += '</div>';
												search_pro += '</div>';
											search_pro += '</div>';
									search_pro += '</div>';
								search_pro += '</article>';
							search_pro += '</div>';
						})
						$("#searched_products").append(search_pro);
					} else {
						$("#searched_products").html("<img src='<?= base_url() . 'data/product_images/no-data-found.jpg' ?>'>");
					}
				},
				error: function(jsonResponse) {
					console.log(jsonResponse);
				}
			})

			// search box category change event
			$(document).off('change', '.search_box_category');
			$(document).on('change', '.search_box_category', function(e) {
				e.preventDefault();
				e.stopPropagation();
				let price_min = parseFloat($('#price-min').text().replace(/\$|\.00/g, ''));
				let price_max = parseFloat($('#price-max').text().replace(/\$|\.00/g, ''));
				let search = '<?php echo $this->input->get('keywords') ?>';

				let filter_obj = {
					search: search,
					categories: [],	
					price: `${price_min}:${price_max}`,
					limit: 7,
					page: 1
				}

				$('input[name="cate"]:checked').next().map((i, v) => {
					filter_obj.categories.push($(v).attr('data-category-id'));
				});

				filter_obj.categories.push($(this).val());
				if ($.inArray('All Categories', filter_obj.categories) !== -1) {
					let indexToRemove = filter_obj.categories.indexOf('All Categories');
					if (indexToRemove !== -1) {
						filter_obj.categories.splice(indexToRemove, 1);
					}
				}
				$.ajax({
					url: "<?= base_url() . 'Product/search' ?>",
					type: "POST",
					dataType: "json",
					data: filter_obj,
					success: function(jsonResponse) {
						if (jsonResponse.success == 1 && jsonResponse.data.products.length > 0) {
							let search_pro = '';
							jsonResponse.data.products.map((pro) => {
								search_pro += '<div class="product search_result_products" data-pro-id="' + pro.id + '">';
								search_pro += '<article>';
									search_pro += '<div class="media-left">';
									search_pro += '<div class="item-img">';
										search_pro += '<a href="<?= base_url() . 'product/detail/' ?>' + pro.id + '"><img class="img-responsive" src="	' + pro.img + '" alt=""></a></div>';
									search_pro += '</div>';
									search_pro += '<div class="media-body">';
										search_pro += '<div class="row">';
											search_pro += '<div class="col-sm-7"> <span class="tag">' + pro.category + '</span><a href=""<?= base_url() . 'product/detail/' ?>' + pro.id + '"" class="tittle">' + pro.name + '</a>';
												search_pro += '<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span></p>';
												search_pro += '<ul class="bullet-round-list">';
													let descStr = ''
													for (let i = 0; i < pro.description.length; i++) {
														descStr += '<li>' + pro.description[i] + '</li>';
													}
												search_pro += descStr;
												search_pro += '</ul>';
											search_pro += '</div>';
											search_pro += '<div class="col-sm-5 text-center"> <a href="#." class="heart"><i class="fa fa-heart heart_icon"></i></a> <a href="#." class="heart navi nevi_icon"><i class="fa fa-navicon"></i></a>';
												search_pro += '<div class="position-center-center">';
													search_pro += '<div class="price productPrice">$' + pro.price + '.00</p>';
														search_pro += '<p>Availability: <span class="in-stock">In stock</span></p>';
														search_pro += '<button type="button" class="btn-round addToCartBtn"><i class="icon-basket-loaded"></i> Add to Cart</a>';
													search_pro += '</div>';
												search_pro += '</div>';
											search_pro += '</div>';
									search_pro += '</div>';
								search_pro += '</article>';
							search_pro += '</div>';
							if(pro.availability == 0){
								$('.in-stock').text('Out of stock')
								$('.in-stock').css({
									'color': '#ff5757',
									'text-decoration': 'none'
								});
							}
							})
							$("#searched_products").html('')
							$("#searched_products").append(search_pro);
						} else {
							$("#searched_products").html("<img src='<?= base_url() . 'data/product_images/no-data-found.jpg' ?>'>");
						}
					},
					error: function(jsonResponse) {
						console.log(jsonResponse);
					}
				})
			})

			$(document).off('click', '.search_magnifierBtn,.filter_btn')
			$(document).on('click', '.search_magnifierBtn,.filter_btn', function(e) {
				e.preventDefault();
				if( $('.search_input').val() !== ''){
				let price_min = parseFloat($('.price-min').text().replace(/\$|\.00/g, ''));
				let price_max = parseFloat($('.price-max').text().replace(/\$|\.00/g, ''));
				let search = $('#search_input_box').val();
				let filter_obj = {
					search: search,
					categories: [],
					price:`${price_min}:${price_max}`, 
					limit: 7,
					page: 1
				}

				$('input[name="cate"]:checked').next().map((i, v) => {
					filter_obj.categories.push($(v).attr('data-category-id'));  //Checkbox value
				});
				filter_obj.categories.push($('#selectCategory').val()); //Search Category Value
				if ($.inArray('All Categories', filter_obj.categories) !== -1) {
					let indexToRemove = filter_obj.categories.indexOf('All Categories');
					if (indexToRemove !== -1) {
						filter_obj.categories.splice(indexToRemove, 1);
					}
				}

				$.ajax({
					url: "<?= base_url() . 'Product/search' ?>",
					type: "POST",
					dataType: "json",
					data: filter_obj,
					success: function(jsonResponse) {
						if (jsonResponse.success == 1 && jsonResponse.data.products.length > 0) {

							let search_pro = '';
							jsonResponse.data.products.map((pro) => {
								search_pro += '<div class="product search_result_products" data-pro-id="' + pro.id + '">';
									search_pro += '<article>';
										search_pro += '<div class="media-left">';
										search_pro += '<div class="item-img">';
											search_pro += '<a href="<?= base_url() . 'product/detail/' ?>' + pro.id + '"><img class="img-responsive" src="	' + pro.img + '" alt=""></a></div>';
										search_pro += '</div>';
										search_pro += '<div class="media-body">';
											search_pro += '<div class="row">';
												search_pro += '<div class="col-sm-7"> <span class="tag">' + pro.category + '</span><a href=""<?= base_url() . 'product/detail/' ?>' + pro.id + '"" class="tittle">' + pro.name + '</a>';
													search_pro += '<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span></p>';
													search_pro += '<ul class="bullet-round-list">';
														let descStr = ''
														for (let i = 0; i < pro.description.length; i++) {
															descStr += '<li>' + pro.description[i] + '</li>';
														}
													search_pro += descStr;
													search_pro += '</ul>';
												search_pro += '</div>';
												search_pro += '<div class="col-sm-5 text-center"> <a href="#." class="heart"><i class="fa fa-heart heart_icon"></i></a> <a href="#." class="heart navi nevi_icon"><i class="fa fa-navicon"></i></a>';
													search_pro += '<div class="position-center-center">';
														search_pro += '<div class="price productPrice">$' + pro.price + '.00</p>';
															search_pro += '<p>Availability: <span class="in-stock">In stock</span></p>';
															search_pro += '<button type="button" class="btn-round addToCartBtn"><i class="icon-basket-loaded"></i> Add to Cart</a>';
														search_pro += '</div>';
													search_pro += '</div>';
												search_pro += '</div>';
										search_pro += '</div>';
									search_pro += '</article>';
								search_pro += '</div>';
							})
							$("#searched_products").html('')
							$("#searched_products").append(search_pro);

						} else {
							$("#searched_products").html("<img src='<?= base_url() . 'data/product_images/no-data-found.jpg' ?>'>");
						}
					},
					error: function(jsonResponse) {
						console.log(jsonResponse);
					}
				})
			}
			});

			// price slider
			$("#price-range").noUiSlider({
				range: {
					'min': [1],
					'max': [10000]
				},
				start: [1, 8835.46],
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

			// Add to cart Process

			$(document).off('click', '.addToCartBtn')
			$(document).on('click', '.addToCartBtn', function(e) {

				e.preventDefault();
				let product_id = parseInt($(this).closest('.search_result_products').attr('data-pro-id'));
				let product_div = $(this).closest('div')
				let product_price = $(this).closest('.search_result_products').find('.productPrice').text().replace(/\$|\.00/g, '');

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
							}
							else if(jsonResponse.errorCode == 909){
								location.href = "<?=base_url().'account/login'?>"	
							} 
							else {
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
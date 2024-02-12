	<!-- tab Section -->
	<section class="featur-tabs padding-top-60 padding-bottom-60">
		<div class="container">

			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-pills margin-bottom-40 pro_tab_list" role="tablist">
				<li role="presentation" class="active functionality_tab" data-type="featured"><a href="#featur" aria-controls="featur" role="tab" data-toggle="tab">Featured</a></li>
				<li role="presentation" class="functionality_tab" data-type="special"><a href="#special" aria-controls="special" role="tab" data-toggle="tab">Special</a>
				</li>
				<li role="presentation" class="functionality_tab" data-type="onsale"><a href="#on-sal" aria-controls="on-sal" role="tab" data-toggle="tab">Onsale</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Featured -->
				<div role="tabpanel" class="tab-pane active fade in" id="featur">
					<!-- Items Slider -->
					<div class="item-slide-5 with-nav" id="functionality_slider">
					</div>
				</div>
			</div>
		</div>
	</section>




	<script>
		$(document).ready(function() {

			const product_type_slider_ini = () => {
				$("#functionality_slider").owlCarousel({
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

			let featured_html = '';
			let special_html = '';
			let onSale_html = '';

			<?php
			foreach ($pageData['data']['products'] as $product) {
				$type_array = explode(',', $product['functionality']);
			?>

				product_html = '<div class="product product_functionality" data-pro-id=' + <?= $product['id'] ?> + '>';
					product_html += '<article>';
						product_html += '<a href="product/detail/' + <?= $product['id'] ?> + '"><img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . trim($product['img']), 600, 600, 1); ?>" alt=""></a>';
						product_html += '<a href="product/detail/' + <?= $product['id'] ?> + '" class="tittle"><?= substr($product['name'], 0, 45); ?></a>';
						product_html += '<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>';
						product_html += '<div class="price productPriceDiv"><?= "$" . $product['price'] . ".00" ?></div>';
						product_html += '<a href="#." class="cart-btn addToCart"><i class="icon-basket-loaded"></i></a>';
					product_html += '</article>';
				product_html += '</div>';

				<?php if (in_array('featured', $type_array)) { ?>
					featured_html += product_html;
				<?php } ?>

				<?php if (in_array('special', $type_array)) { ?>
					special_html += product_html;
				<?php } ?>

				<?php if (in_array('onsale', $type_array)) { ?>
					onSale_html += product_html;
				<?php } ?>

			<?php } ?>

			$(".tablist_li:first-child").addClass('active');
			$('#functionality_slider').html(featured_html);
			product_type_slider_ini();

			// onClick functionality tab
			$('.functionality_tab').click(function(e) {
				e.preventDefault()

				let functionality_type = $(this).attr('data-type');
				$('#functionality_slider').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');

				if (functionality_type == 'featured') {
					$('#functionality_slider').html(featured_html).fadeIn(500);
				} else if (functionality_type == 'special') {
					$('#functionality_slider').html(special_html).fadeIn(500);
				} else {
					$('#functionality_slider').html(onSale_html).fadeIn(500);
				}
				product_type_slider_ini();
			});

		

			// 	$(document).on('click','.addToCart',function(e){

			// 	e.preventDefault();
			// 	let product_id = parseInt($(this).parent().parent().attr('data-pro-id'));
			// 	let product_price = $('.productPriceDiv').text().replace(/\$|\.00/g, '');

			// 	let ProductData = {
			// 		product_id:product_id,
			// 		product_price:product_price,
			// 		user_id:"<?= $this->session->userdata('sessUserId') ?>",
			// 		qty:1,
			// 		total_amount:product_price,
			// 	}
			// 	$.ajax({
			// 		url:"<?= base_url() . 'product/cart' ?>",
			// 		type:"POST",
			// 		dataType:"json",
			// 		data:ProductData,
			// 		success:function(jsonResponse){
			// 			if(jsonResponse.error == 1 && jsonResponse.errorCode == 101){
			// 				location.href = "<?= base_url() . 'account/login' ?>"
			// 			}
			// 			if(jsonResponse.success == 1){
			// 				setTimeout(() => {
			// 					Swal.fire(
			// 						'Product successfully added to your cart! 🛒',
			// 						'Success',
			// 						'success',
			// 					)
			// 				})
			// 			}
			// 		},
			// 		error:function(jsonResponse){

			// 			setTimeout(() => {
			// 					Swal.fire(
			// 						"Oops! Product could not be added to your cart. ",
			// 						'Please try again later or contact support for assistance.',
			// 						'info'
			// 					)
			// 				})
			// 		}
			// 	})
			// })

		})
	</script>
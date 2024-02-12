<?php $this->load->view('inc/head', array("pageData" => $pageData)) ?>

<body>
	<?php $this->load->view('inc/top_header') ?>
	<?php $this->load->view('inc/header'); ?>
	<!-- MAIN SLIDER -->
	<?php $this->load->view('inc/slider.php'); ?>
	<!-- Content -->
	<div id="content">
		<!-- Shipping Info -->
		<section class="shipping-info">
			<div class="container">
				<ul>
					<!-- Free Shipping -->
					<li>
						<div class="media-left"> <i class="flaticon-delivery-truck-1"></i> </div>
						<div class="media-body">
							<h5>Free Shipping</h5>
							<span>On order over $99</span>
						</div>
					</li>
					<!-- Money Return -->
					<li>
						<div class="media-left"> <i class="flaticon-arrows"></i> </div>
						<div class="media-body">
							<h5>Money Return</h5>
							<span>30 Days money return</span>
						</div>
					</li>
					<!-- Support 24/7 -->
					<li>
						<div class="media-left"> <i class="flaticon-operator"></i> </div>
						<div class="media-body">
							<h5>Support 24/7</h5>
							<span>Hotline: (+100) 123 456 7890</span>
						</div>
					</li>
					<!-- Safe Payment -->
					<li>
						<div class="media-left"> <i class="flaticon-business"></i> </div>
						<div class="media-body">
							<h5>Safe Payment</h5>
							<span>Protect online payment</span>
						</div>
					</li>
				</ul>
			</div>
		</section>
		<!-- CONTENT SLIDER -->
		<?php
		if (count($pageData['data']['products']) > 0) {
			$this->load->view('inc/product_slider');
		}
		?>
		<!-- Top Selling Week -->
		<section class="light-gry-bg padding-top-60 padding-bottom-30">
			<div class="container">
				<!-- heading -->
				<div class="heading">
					<h2>Top Selling of the Week</h2>
					<hr>
				</div>
				<!-- Items -->
				<div class="item-col-5">
					<!-- Product -->
					<div class="product col-2x">
						<div class="like-bnr" style="background: #f5f5f5 url(<?= base_url() . 'assets/front/img/theme/watch-bg.jpg' ?>) right center no-repeat;">
							<div class="position-center-center">
								<h5>Smart Watch 2.0</h5>
								<p>Space Gray Aluminum Case
									with Black/Volt Real Sport Band <span>38mm | 42mm</span> </p>
								<a href="#." class="btn-round">View Detail</a>
							</div>
						</div>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-6.jpg' ?>" alt=""> <span class="sale-tag">-25%</span>
							<!-- Content -->
							<span class="tag">Tablets</span> <a href="#." class="tittle">Mp3 Sumergible Deportivo Slim Con 8GB</a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00 <span>$200.00</span></div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-7.jpg' ?>" alt="">
							<!-- Content -->
							<span class="tag">Appliances</span> <a href="#." class="tittle">Reloj Inteligente Smart Watch M26 Touch
								Bluetooh </a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-8.jpg' ?>" alt=""> <span class="new-tag">New</span>
							<!-- Content -->
							<span class="tag">Accessories</span> <a href="#." class="tittle">Teclado Inalambrico Bluetooth Con Air
								Mouse</a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-9.jpg' ?>" alt="">
							<!-- Content -->
							<span class="tag">Appliances</span> <a href="#." class="tittle">Funda Para Ebook 7" 128GB full HD</a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-10.jp' ?>g" alt="">
							<!-- Content -->
							<span class="tag">Appliances</span> <a href="#." class="tittle">Reloj Inteligente Smart Watch M26 Touch
								Bluetooh </a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-11.jp' ?>g" alt=""> <span class="new-tag">New</span>
							<!-- Content -->
							<span class="tag">Accessories</span> <a href="#." class="tittle">Teclado Inalambrico Bluetooth Con Air
								Mouse</a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-12.jp' ?>g" alt="">
							<!-- Content -->
							<span class="tag">Appliances</span> <a href="#." class="tittle">Funda Para Ebook 7" 128GB full HD</a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
					<!-- Product -->
					<div class="product">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/item-img-1-13.jp' ?>g" alt="">
							<!-- Content -->
							<span class="tag">Appliances</span> <a href="#." class="tittle">Reloj Inteligente Smart Watch M26 Touch
								Bluetooh </a>
							<!-- Reviews -->
							<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span>
							</p>
							<div class="price">$350.00</div>
							<a href="#." class="cart-btn"><i class="icon-basket-loaded"></i></a>
						</article>
					</div>
				</div>
			</div>
		</section>

		<!-- Main Tabs Sec -->
		<section class="main-tabs-sec padding-top-60 padding-bottom-0">
			<div class="container">
				<ul class="nav margin-bottom-40" role="tablist" id="category_tablist">
					<?php


					foreach ($pageData['data']['categories']['random'] as $category) { ?>
						<li role="presentation" class="tablist_li" data-category-id=<?= $category['id'] ?>><a href="#tv-au" aria-controls="featur" role="tab" data-toggle="tab">
								<i class="<?= $category['icon'] ?>"></i><?= $category['name'] ?><span><?= $category['product_count']; ?> item</span></a>
						</li>
					<?php } ?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<!-- TV & Audios -->
					<div role="tabpanel" class="tab-pane active fade in" id="tv-au">
						<!-- Items -->
						<div class="item-slide-5 with-bullet no-nav item-slider" id="category_slider">
						<?php $product_html = ''; ?>
						<?php foreach ($pageData['data']['products'] as $product) { 
							$product_html .= '<div class="product product_items" category-id="'.$product["category_id"].'" data-pro-id="'.$product['id'].'">';
								$product_html .= '<article>'; echo $product['img'];
									$product_html .='<a href="product/detail/'.$product['id'].'" class="tittle"><img class="img-responsive" src="'.getImage(base_url() . 'data/product_images/' . trim($product['img']), 600, 600).'" alt=""></a>';
									$product_html .= '<span class="tag">'.$product['category'].'</span> <a href="product/detail/'.$product['id'].'" class="tittle">'.substr($product['name'], 0, 45).'</a>';
									$product_html .= '<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5';
									$product_html .= 'Review(s)</span></p>';
									$product_html .= '<div class="price productPriceDiv">$'.$product['price'] .'.00</div>';
									$product_html .= '<button type="button" class="cart-btn addToCart"><i class="icon-basket-loaded"></i></a>';
								$product_html .= '</article>';
							$product_html .= '</div>';
						} ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Top Selling Week -->
		<section class="padding-top-60 padding-bottom-60">
			<div class="container">

				<!-- heading -->
				<div class="heading">
					<h2>From our Blog</h2>
					<hr>
				</div>
				<div id="blog-slide" class="with-nav">

					<!-- Blog Post -->
					<div class="blog-post">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/blog-img-1.jpg' ?>" alt="">
							<span><i class="fa fa-bookmark-o"></i> 25 Dec, 2017</span> <span><i class="fa fa-comment-o"></i> 86
								Comments</span> <a href="#." class="tittle">It’s why there’s nothing else like Mac. </a>
							<p>Etiam porttitor ante non tellus pulvinar, non vehicula lorem fermentum. Nulla vitae efficitur mi
								[...] </p>
							<a href="#.">Readmore</a>
						</article>
					</div>

					<!-- Blog Post -->
					<div class="blog-post">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/blog-img-2.jpg' ?>" alt="">
							<span><i class="fa fa-bookmark-o"></i> 25 Dec, 2017</span> <span><i class="fa fa-comment-o"></i> 86
								Comments</span> <a href="#." class="tittle">Get the power to take your business to the
								next level. </a>
							<p>Etiam porttitor ante non tellus pulvinar, non vehicula lorem fermentum. Nulla vitae efficitur mi
								[...] </p>
							<a href="#.">Readmore</a>
						</article>
					</div>

					<!-- Blog Post -->
					<div class="blog-post">
						<article> <img class="img-responsive" src="<?= base_url() . 'assets/front/img/theme/blog-img-3.jpg' ?>" alt="">
							<span><i class="fa fa-bookmark-o"></i> 25 Dec, 2017</span> <span><i class="fa fa-comment-o"></i> 86
								Comments</span> <a href="#." class="tittle">It’s why there’s nothing else like Mac. </a>
							<p>Etiam porttitor ante non tellus pulvinar, non vehicula lorem fermentum. Nulla vitae efficitur mi
								[...] </p>
							<a href="#.">Readmore</a>
						</article>
					</div>
				</div>
			</div>
		</section>


		<!-- GO TO TOP  -->
		<a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a>
		<!-- GO TO TOP End -->
	</div>

	<?php $this->load->view('inc/footer.php'); ?>
</body>

</html>
<script>
	$(document).ready(function() {
		const category_type_slider_ini = () => {
			$("#category_slider").owlCarousel({
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

		let product_html = '<?=$product_html?>';
		

		// Onclick Category Tab
		$('.tablist_li').click(function(e) {
        e.preventDefault();
        var categoryId = $(this).data('category-id');
        var filteredProducts = $(product_html).filter('.product_items[category-id="' + categoryId + '"]');
        $("#category_slider").trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded').empty();
        filteredProducts.each(function() {
			$("#category_slider").append($(this));
        });
		category_type_slider_ini();
		})
		let category_Id = $('.tablist_li').first().attr('data-category-id')
		let first_category_pro = $(product_html).filter('.product_items[category-id="' + category_Id + '"]');
		$('#category_slider').html(first_category_pro);
		category_type_slider_ini();
		})

		
		
		
		
</script>
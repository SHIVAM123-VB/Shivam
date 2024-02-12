<?php $this->load->view('inc/head', array("pageData" => $pageData)) ?>
<?php $this->load->view('inc/top_header') ?>
<?php $this->load->view('inc/header'); ?>
<div id="content">
	<style>
		hr {
			border: 1px solid black;
			margin: 10px 0;
		}

		.total_amount {
			font-weight: 600;
			margin-left: 750px;
		}
	</style>
	<!-- Products -->
	<section class="padding-top-40 padding-bottom-60 parent_container">
		<div class="container">
			<div class="row">

				<div class="col-md-10">
					<!-- Items -->
					<div class="col-list">
						<?php if (isset($pageData['data']['orderProducts']) && count($pageData['data']['orderProducts']) > 0) {
							$order_id = 0;
							foreach ($pageData['data']['orderProducts'] as $index => $orderProducts) {
						?>
								<div class="product order_products" data-status="<?= $orderProducts['status'] ?>">
									<article>
										<div class="media-left">
											<a href="<?= 'product/detail/' . $orderProducts['product_id'] ?>" class="tittle">
												<div class="item-img"> <img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . $orderProducts['img'], 600, 600) ?>" alt=""> </div>
											</a>
										</div>
										<div class="media-body">
											<div class="row">
												<div class="col-sm-7"> <span class="tag"><?= $orderProducts['category'] ?></span> <a href="<?= 'product/detail/' . $orderProducts['product_id'] ?>" class="tittle"><?= $orderProducts['name'] ?></a>
													<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="margin-left-10">5 Review(s)</span></p>
													<ul class="bullet-round-list">
														<span>Quantity : </span><?= $orderProducts['qty'] ?><br>
														<span>Total Price : </span><?= "$" . $orderProducts['total_price'] . '.00' ?>
													</ul>
												</div>
												<div class="col-sm-5 text-center right-section" data-orderItem-id="<?=$orderProducts['o_item_id']?>">
													<div class="position-center-center">
														<div class="price"><?= '$' . $orderProducts['price'] . '.00' ?></div>
														<div class="price">
															<div>
																<?php if($orderProducts['status'] == 'active'){?>
																<button class="btn-round cancel_btn" data-order-id="<?= $orderProducts['order_id'] ?>" data-orderItem-id="<?= $orderProducts['o_item_id'] ?>">Cancel Purchase</button>
															<?php }?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</article>
								</div>
								
						<?php
								$order_id = $orderProducts['order_id'];
								if (
									($order_id != 0 &&
										isset($pageData['data']['orderProducts'][$index + 1]['order_id']) &&
										$order_id != $pageData['data']['orderProducts'][$index + 1]['order_id']) ||
									!isset($pageData['data']['orderProducts'][$index + 1]['order_id'])
								) {
									$granTotalHtml = '';
									$granTotalHtml .= "<div>";
										$granTotalHtml .= "<span class='total_amount'>";
											$granTotalHtml .= "Grand total :";
										$granTotalHtml .= "</span>";
										$granTotalHtml .= "<b class='grand_total' data-order-id='" . $orderProducts['order_id'] . "'>$";
												$granTotalHtml .= $orderProducts['grand_total'] . '.00';
										$granTotalHtml .= "</b>";
									$granTotalHtml .= "</div>";
									$granTotalHtml .= "<hr> <br><br>";
									echo $granTotalHtml;
								}
							}
						} ?>
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
				<?php if (isset($pageData['data']['random_products']) && count($pageData['data']['random_products']) > 0) {
					foreach ($pageData['data']['random_products'] as $randomProducts) {
				?>
						<div class="product" data-pro-id=<?= $randomProducts['id'] ?>>
							<article>
								<a href="<?= base_url() . 'product/detail/' . $randomProducts['id'] ?>">
									<img class="img-responsive" src="<?= getImage(base_url() . 'data/product_images/' . trim($randomProducts['img']), 600, 600) ?>" alt="">
								</a>
								<span class="tag"><?= $randomProducts['category'] ?></span> <a href="<?= base_url() . 'product/detail/' . $randomProducts['id'] ?>" class=""><?= substr($randomProducts['name'], 0, 45) ?></a>
								<p class="rev"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="margin-left-10">5 Review(s)</span></p>
								<div class="price productPriceDiv"><?= '$' . $randomProducts['price'] . '.00' ?></div>
								<button type="button" class="cart-btn addToCart"><i class="icon-basket-loaded"></i></button>
							</article>
						</div>
				<?php
					}
				} ?>
			</div>
		</div>
	</section>

</div>
<?php $this->load->view('inc/footer.php'); ?>
<script>
	$(document).ready(() => {
		// random products slider
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

		$(document).off('click', '.cancel_btn');
		$(document).on('click', '.cancel_btn', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Do you want to Cancel the Product?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.isConfirmed) {
					let orderData = {
						orderItem_id: $(this).attr('data-orderItem-id'),
						order_id: $(this).attr('data-order-id')
					}
					$.ajax({
						url: "<?= base_url() . 'orders/cancel_product' ?>",
						type: "POST",
						dataType: "json",
						data: orderData,
						success: function(jsonResponse) {
							let button_html = ''
							if (jsonResponse.success == 1 && jsonResponse.error == 0) {
								
								$('.cancel_btn[data-orderItem-id="' + orderData.orderItem_id + '"]').remove();
								button_html = '<span class="">';
										button_html += '<button	class="btn-round text-danger purchase_cancelledBtn">Cancelled</button>';
								button_html += '</span>';
								$('.right-section[data-orderItem-id="' + orderData.orderItem_id + '"]').prepend(button_html);
								$('.grand_total[data-order-id="' + orderData.order_id + '"]').text('$' + jsonResponse.data + '.00');
							}
						},
						error: function(jsonResponse) {
							setTimeout(() => {
								Swal.fire(
									"Oops! Product not removed. ",
									'Please try again later or contact support for assistance.',
									'error'
								)
							})
						}
					})
				}
			})
		})

		// No products  found 
		if ($('.order_products').length === 0) {
			$('.parent_container').html("<h1 class='text-center m-5 padding-bottom-100'>No Products Found</h1>");
		}

		// checking cancelled products
		// let button_html = '';
		$('.order_products').each(function() {
			if ($(this).attr('data-status') === 'trash') {
				let button_html = '<span class="">';
				button_html += '<button	class="btn-round text-danger purchase_cancelledBtn">Cancelled</button>';
				button_html += '</span>';
				$(this).find('.right-section').prepend(button_html);
			}
		})
		
	})
</script>
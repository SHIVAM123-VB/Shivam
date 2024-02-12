<header>
	<style>
		.search_box_input {
			border: 0px !important;
		}
	</style>
	<div class="container">

		<div class="logo"> <a href="<?= base_url() ?>"><img src="<?= base_url() . 'assets/front/img/theme/logo.png" alt=""' ?>"></a> </div>
		<div class="search-cate">
			<?php
			$currentURL = current_url();
			if (strstr($currentURL, '/product/listing')) { ?>
				<select class="selectpicker search_box_category" id="selectCategory">
					<option> All Categories</option>
					<?php if (isset($pageData['data']['categories'])) { ?>
						<?php foreach ($pageData['data']['categories'] as $category) { ?>
							<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
					<?php
						}
					} ?>
				</select>
				<input type="search" placeholder="Search entire store here..." class="search_input" id="search_input_box">
				<button class="submit search_magnifierBtn" type="button"><i class="icon-magnifier"></i></button>
			<?php } else { ?>
				<input type="search" placeholder="Search entire store here..." class="search_input search_box_input ">
				<button class="submit searchBtn" type="submit"><i class="icon-magnifier"></i></button>
			<?php } ?>

		</div>

		<!-- Cart Part -->
		<?php if ($this->session->has_userdata('sessUserId') == TRUE) {	 ?>

			<ul class="nav navbar-right cart-pop">
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <a href="<?= base_url() . 'Cart' ?>"><span class="itm-cont"><?= isset($pageData['data']['cartDetails'][0]['total_Products']) ? $pageData['data']['cartDetails'][0]['total_Products'] : 0 ?></span><i class="flaticon-shopping-bag"></i></a> <strong>My Cart</strong> <br>
						<span class="total_pro_head"><?= isset($pageData['data']['cartDetails'][0]['total_Products']) ? $pageData['data']['cartDetails'][0]['total_Products'] : 0 ?> item(s) - <?= isset($pageData['data']['cartDetails'][0]['productsSum']) ? '$' . $pageData['data']['cartDetails'][0]['productsSum'] . '.00' : '$' . 0 . '.00' ?></span></a>
					<ul class="dropdown-menu" id="cardDetails_dropdown">
						<?php if (isset($pageData['data']['cartDetails'])) {
							foreach ($pageData['data']['cartDetails'] as $cardDetails) { ?>
								<li>
									<div class="media-left"> <a href="<?= base_url() . 'product/detail/' . $cardDetails['product_id'] ?>" class="thumb"> <img src="<?= getImage(base_url() . 'data/product_images/' . $cardDetails['img'], 600, 600) ?>" class=" img-responsive" alt=""> </a>
									</div>
									<div class="media-body"> <a href="<?= base_url() . 'product/detail/' . $cardDetails['product_id'] ?>" class="tittle"><?= $cardDetails['name'] ?></a> </div>
								</li>
						<?php }
						} ?>
						<?= isset($pageData['data']['cartDetails']) && count($pageData['data']['cartDetails']) > 0 ? '<li class="btn-cart"> <a href="' . base_url() . 'Cart' . '" class="btn-round">View Cart</a> </li>' : '' ?>
					</ul>
				</li>
			</ul>
		<?php } ?>
	</div>
	<!-- Nav -->

	<nav class="navbar ownmenu">
		<div class="container">

			<!-- Categories -->
			<div class="cate-lst"> <a data-toggle="collapse" class="cate-style" href="#cater"><i class="fa fa-list-ul"></i>
					Our Categories </a>
				<div class="cate-bar-in">
					<div id="cater" class="collapse">

						<ul id="categories_carousel">
							<?php
							if (isset($pageData['data']['categories'])) {
								foreach ($pageData['data']['categories'] as  $index => $category) { ?>
									<li><a href=""><?= $category['name'] ?></a></li>
							<?php
									if ($index > 9) {
										break;
									}
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="collapse navbar-collapse ml-3" id="nav-open-btn">
				<?php if ($this->session->has_userdata('sessUserId') == TRUE) { ?>
					<ul class="nav">
						<li> <a href="<?= base_url() . 'account' ?>">Account</a></li>
						<li> <a href="<?= base_url() . 'orders' ?>">My Orders</a></li>
					</ul>
				<?php
				} ?>
			</div>
			<!-- Navbar Header -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span><i class="fa fa-navicon"></i></span> </button>
			</div>

			<!-- NAV RIGHT -->
			<div class="nav-right"> <span class="call-mun"><i class="fa fa-phone"></i> <strong>Hotline:</strong> (+100)
					123 456 7890</span> </div>
		</div>
	</nav>
</header>

<div class="linking">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="<?= base_url() ?>">Home</a></li>
			<li class="active"><?= $pageData['browserTitle'] ?></li>
		</ol>
	</div>
</div>

<!-- <div class="container">
	<section class="header">
		<div class="row">
			<div class="col-md-12">
				<a href="<?= base_url() ?>">
					<?php
					$logo_img = $this->ideate_model->get_settings('site_logo');
					if ($logo_img <> "") {
						$logo_img = 'data/site_images/' . $logo_img;
					}
					?>
					<img src="<?= base_url($logo_img) ?>" alt="<?= SITE_NAME ?>" name="<?= SITE_NAME ?>" height="90"
						style="display:block;" />
				</a>
			</div>
		</div>
	</section>
</div> -->
<script>
	$(document).ready(function() {
		let redirect = () => {
			let search_box_input = $('.search_input').val();
			location.href = '<?= base_url() . 'product/listing?keywords=' ?>' + search_box_input
		}
		$('.searchBtn').on('click', function() {
			let search_box_input = $('.search_input').val();
			if (search_box_input !== '') {
				redirect();
			}
		});
		let checkClass = false;
		if ($('#cardDetails_dropdown').children().length === 0) {
			let removeClass = $('#cardDetails_dropdown').removeClass('dropdown-menu');
			if (removeClass) {
				checkClass = true;
			} else {
				checkClass = false;
			}
		} else {
			if (checkClass === true) {
				$('#cardDetails_dropdown').addClass('dropdown-menu');
			}
		}
	})
</script>
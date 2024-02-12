<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	$this->config =& get_config();
	$base_url = $this->config['base_url'];
?>
<title>Error 404</title>
<?php $this->load->view("inc/head")?>
<?php $this->load->view("inc/top_header");?>
<?php $this->load->view("inc/header")?>
<!-- Content -->
<div id="content"> 
    
    <!-- Error Page -->
    <section>
      <div class="container">
        <div class="order-success error-page"> <img src="<?=base_url().'assets/front/img/theme/error-img.jpg'?>" alt="">
          <h3>Error <span>404</span> Not Found</h3>
          <p>We’re sorry but the page you are looking for does nor exist.<br>
            You could return to <a href="#.">homepage</a> or using <a href="#.">search!</a></p>
        </div>
      </div>
    </section>


		<?php $this->load->view("inc/footer")?>
<!DOCTYPE html>
<html lang="en">
</style>

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Dashboard</title>
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/admin/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <?php $this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'head') ?>
</head>

  <body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <a href="<?= base_url() ?>" class="text-light">
          <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="<?= base_url('assets/admin/brand/coreui.svg#full') ?>"></use>
          </svg>
        </a>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <?php
        if (isset($this->admin_model->leftSidebarLinks) && count($this->admin_model->leftSidebarLinks) > 0) {
          foreach ($this->admin_model->leftSidebarLinks as $leftSidebarLink) { ?>
            <li class="nav-group">
              <a class="nav-link nav-group-toggle" href="<?= $leftSidebarLink['url'] ?>">
                <span class="mx-2"><i class="fa <?= $leftSidebarLink['faIconClass'] ?>"></i></span>
                <?= $leftSidebarLink['title'] ?>
              </a>
              <ul class="nav-group-items">
                <?php
                if (isset($leftSidebarLink['childLinks']) && count($leftSidebarLink['childLinks']) > 0) {
                  foreach ($leftSidebarLink['childLinks'] as $childLinks) { ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $childLinks['url'] ?>"><span class="nav-icon"></span><?= $childLinks['title'] ?></a></li>
                <?php
                  }
                }
                ?>
              </ul>
            </li>
        <?php
          }
        }
        ?>

        <li class="nav-divider"></li>

      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid user_dropdown" style="justify-content: end;">
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
              <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="<?= base_url('assets/admin/img/avatars/8.jpg') ?>" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <a class="dropdown-item" href="#">Account</a>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
      </header>
     <?php $this->load->view(SITE_ADMIN_DIR_NAME . '/common/template')?>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url('assets/admin/plugins/@coreui/coreui/js/coreui.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/plugins/simplebar/js/simplebar.min.js') ?>"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="<?= base_url('assets/admin/plugins/chart.js/js/chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/plugins/@coreui/chartjs/js/coreui-chartjs.js') ?>"></script>
    <script src="<?= base_url('assets/admin/plugins/@coreui/utils/js/coreui-utils.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/main.js') ?>"></script>

  </body>

</html>
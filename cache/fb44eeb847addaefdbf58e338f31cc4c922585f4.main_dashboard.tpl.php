<?php
/* Smarty version 4.1.1, created on 2022-09-22 16:36:32
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\main_dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_632c1080237de0_31982261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0ad64abdd82845ff082cbddadd38bbc320b28d1' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\main_dashboard.tpl',
      1 => 1663823957,
      2 => 'file',
    ),
    '9540185d069d57eac05a1fab46576afabc96ac8c' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\html5_header.tpl',
      1 => 1663818813,
      2 => 'file',
    ),
    '549c7633431274e78c1676427cd96dcf7caa6b99' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\menu_dashboard.tpl',
      1 => 1662201500,
      2 => 'file',
    ),
    '61990977f81d6ec17e6608ec468473dc1a578f7a' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\html5_layout.tpl',
      1 => 1662783015,
      2 => 'file',
    ),
    'ac2f4be61bb56a4e0ee32ef2290c9a0654b4b994' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\html5_foot_copyright.tpl',
      1 => 1662263044,
      2 => 'file',
    ),
    'd2d8ea4df1ed6bb3eef85929e4fb8c256734be66' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\html5_footer.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_632c1080237de0_31982261 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>메인:::Smart Premiere</title>

    <meta name="description" content="" />

    <!-- 아이콘 -->
    <link rel="icon" type="image/x-icon" href="../../icon/small_logo.ico" />

    <!-- 글꼴 -->
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/css/smart_premiere.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../library/sneat-1.0.0/assets/vendor/js/helpers.js"></script>
    <script src="../../library/sneat-1.0.0/assets/js/config.js"></script>
  
	  <link rel="stylesheet" href="../../library/c3/c3.css">
	  <script src="../../library/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../library/chartjs-3.9.1/chart.js"></script>

    <!-- <script src="../../library/c3/c3.js"></script> -->
    <script src="../../library/d3/d3.v5.min.js"></script>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- 메뉴 -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand logo">
            <a href="main" class="app-brand-link">
              <span class="app-brand-logo logo">
                <img src="../../images/small_logo.png">
              </span>
              <span class="app-brand-text logo menu-text fw-bolder ms-2">Smart<br>Premiere</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="main" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">대시보드</div>
              </a>
            </li>

            <!-- 게시판 -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">게시판</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="board?func=list&boardname=notice" class="menu-link">
                    <div data-i18n="board notice">공지사항</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- 프로젝트/제품 -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">프로젝트/제품</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="project?func=register" class="menu-link">
                    <div data-i18n="project register">프로젝트 등록</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="project?func=list" class="menu-link">
                    <div data-i18n="project status">프로젝트 현황</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="product?func=register" class="menu-link">
                    <div data-i18n="product register">제품 등록</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="product?func=list" class="menu-link">
                    <div data-i18n="product status">제품 현황</div>
                  </a>
                </li>
              </ul>
            </li>


            <!-- 창고 -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">창고</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="logistics?func=input" class="menu-link">
                    <div data-i18n="logistics input">입고</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="logistics?func=output" class="menu-link">
                    <div data-i18n="logistics output">출고</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- 장비/상태 -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">장비/상태</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="machine?type=sensor&func=list&sort=dht" class="menu-link">
                    <div data-i18n="sensor dht">온습도 센서</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="machine?type=sensor&func=list&sort=shock" class="menu-link">
                    <div data-i18n="sensor shock">충격감지 센서</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="machine?type=sensor&func=list&sort=ultrasonic" class="menu-link">
                    <div data-i18n="sensor ultrasonic">초음파 센서</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">설정</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">계정</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="member?func=register" class="menu-link">
                    <div data-i18n="Account register">사용자 등록</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="member?func=list" class="menu-link">
                    <div data-i18n="Account Mgt">사용자 관리</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">권한</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="member_auth?func=register" class="menu-link">
                    <div data-i18n="Basic">권한 등록</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="member_auth?func=list" class="menu-link">
                    <div data-i18n="Basic">권한 관리</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">장비</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="machine?func=register" class="menu-link">
                    <div data-i18n="Error">장비 등록</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="machine?func=list" class="menu-link">
                    <div data-i18n="Under Maintenance">장비 관리</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
<!-- / 메뉴 -->        

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="검색..."
                    aria-label="검색..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  
                </li>

                <!-- User(사용자) -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../library/sneat-1.0.0/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../library/sneat-1.0.0/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">정도윤</span>
                            <small class="text-muted">관리자</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">내 정보</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">설정</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">메시지</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../../index.php/sso/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">로그아웃</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
    <script type="text/javascript">

      function goBoardView(boardname, id){
        location.replace('board?func=view&boardname=' + boardname + '&id=' + id);
      }

	</script>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">공지사항!</h5>
                                                    <a href="javascript:goBoardView('notice', '');" class="btn btn-sm btn-outline-primary">더 보기</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../../library/sneat-1.0.0/assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="../../library/sneat-1.0.0/assets/illustrations/man-with-laptop-dark.png"
                            data-app-light-img="../../library/sneat-1.0.0/assets/illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../library/sneat-1.0.0/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">폴더 용량</span>
                          <h3 class="card-title mb-2">99.48 MB</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>-->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../library/sneat-1.0.0/assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>업무</span>
                          <h3 class="card-title text-nowrap mb-1">4건</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 차트1, 차트2 -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">입출고 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: 2022-09-01 ~ 2022-10-01</span>
							          <div style="width:100%;">
                          <canvas id="canvas1" style="height:50%; width:50%"></canvas>
                        </div>
                        <!--<div id='chart1' class="px-2"></div>-->
                      </div>
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">전체 입출고 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: 2022-01-01 ~ 2023-01-01</span>
                        <canvas id="canvas2"></canvas>
							          <!--<div id='chart2' class="px-2"></div>-->
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../library/sneat-1.0.0/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt4"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="d-block mb-1">사용자 수</span>
                          <h3 class="card-title text-nowrap mb-2">3명</h3>
                          <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../library/sneat-1.0.0/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">DB 용량</span>
                          <h3 class="card-title mb-2">0.5 MB</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>-->
                        </div>
                      </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                    <div class="col-12 mb-4">
                      
                      </div>
                    </div>
                  </div>
                
                <!-- 입출고 현황 -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">장비 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: 2022-09-01 ~ 2022-10-01</span>
							          <!--<div id='chart3' class="px-2"></div>-->
                        <canvas id="canvas3"></canvas>
                      </div>
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">전체 장비 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: 2022-01-01 ~ 2023-01-01</span>
							          <!--<div id='chart4' class="px-2"></div>-->
                        <canvas id="canvas4"></canvas>
                      </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
        ©
        <script>
        document.write(new Date().getFullYear());
        </script>
        , Smart Premiere(스마트 프리미어), XOR파이<br>
        접속시간: 2022-09-22 16:36:32 - 개발
    </div>
    </div>
</footer>
<!-- / Footer -->            
            <!-- 차트 -->
            <script type="text/javascript">
              
              function createChart1(){
                new Chart(document.getElementById("canvas1"), {
                  type: 'pie',
                  data: {
                      labels: ['입고', '출고'],
                      datasets: [{
                          label: '입고',
                          data: [ 6, 3 ],
                          borderColor: ["rgba(51, 153, 255, 1)", "rgba(255, 201, 14, 1)"],
                          backgroundColor: ["rgba(0, 102, 204, 0.5)", "rgba(255, 201, 14, 0.5)"],
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }
            
            function createChart2(){
                new Chart(document.getElementById("canvas2"), {
                  type: 'bar',
                  data: {
                      labels: [
                                                          '1',
                                                          '2',
                                                          '3',
                                                          '4',
                                                          '5',
                                                          '6',
                                                          '7',
                                                          '8',
                                                          '9',
                                                          '10',
                                                          '11',
                                                          '12',
                                                  ],
                      datasets: [{
                          label: '입고',
                          data: [ 
                                                          '0',
                                                          '0',
                                                          '0',
                                                          '0',
                                                          '0',
                                                          '0',
                                                          '0',
                                                          '75',
                                                          '6',
                                                          '0',
                                                          '0',
                                                          '0',
                                                      ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '출고',
                          data: [ 3 ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }

            
              function createChart3(){
                new Chart(document.getElementById("canvas3"), {
                  type: 'bar',
                  data: {
                      labels: ['1', '2', '3'],
                      datasets: [{
                          label: '로봇팔1',
                          data: [ '30', '40', '100' ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '로봇팔2',
                          data: [ '40', '60', '70' ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }
            
            function createChart4(){
                new Chart(document.getElementById("canvas4"), {
                  type: 'bar',
                  data: {
                      labels: ['1', '2', '3'],
                      datasets: [{
                          label: '로봇팔1',
                          data: [ '30', '40', '100' ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '로봇팔2',
                          data: [ '40', '60', '70' ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }

            createChart1();
            createChart2();
            createChart3();
            createChart4();
            
            </script>

            <!--
            <script type="text/javascript">
              var generate1 = function () { 
                return c3.generate({
                  bindto: '#chart1',
                  data: {
                  columns: [
                    ['입고', 6],
                    ['출고', 3]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart1 = generate1();
              
              var generate2 = function () { 
                return c3.generate({
                  bindto: '#chart2',
                  data: {
                  columns: [
                    ['입고', 81],
                    ['출고', 3]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart2 = generate2();

              var generate3 = function () { 
                return c3.generate({
                  bindto: '#chart3',
                  data: {
                  columns: [
                    ['로봇팔1', 30, 200, 100],
                    ['로봇팔2', 0, 0, 0]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart3 = generate3();
                            
              var generate4 = function () { 
                return c3.generate({
                  bindto: '#chart4',
                  data: {
                  columns: [
                    ['로봇팔1', 30, 200, 100],
                    ['로봇팔2', 0, 0, 0]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart4 = generate4();

            </script>
            -->  

<div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../library/sneat-1.0.0/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../library/sneat-1.0.0/assets/vendor/libs/popper/popper.js"></script>
    <script src="../../library/sneat-1.0.0/assets/vendor/js/bootstrap.js"></script>
    <script src="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../library/sneat-1.0.0/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../library/sneat-1.0.0/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../library/sneat-1.0.0/assets/js/main.js"></script>

  </body>
</html>
<?php }
}

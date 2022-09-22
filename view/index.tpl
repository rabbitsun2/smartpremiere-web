<!DOCTYPE html>
<html lang="ko" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="./library/sneat-1.0.0/assets" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{$title} - {$service_mode}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./icon/small_logo.ico" />

    <!-- Fonts -->
    <link href="./dist/fonts/NanumGothic/fonts.css" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/css/smart_premiere.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="./library/sneat-1.0.0/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="./library/sneat-1.0.0/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./library/sneat-1.0.0/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <img src="./images/small_logo.png" alt="로고">
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to {$title}.</h4>
              <p class="mb-5"> 제조/물류 실행 시스템 </p>

              <form id="formAuthentication" class="mb-3" action="index.php/sso/login" method="POST">
              <input type="hidden" name="token" value="{$token}">
                <div class="mb-3">
                  <label for="email" class="form-label"> E-mail </label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="이메일 주소를 입력하세요"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="index.php/member/passwd_find">
                      <small>비밀번호 찾기</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="passwd"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> 로그인 상태 유지 </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">로그인</button>
                </div>
              </form>
                <a href="index.php/member/register">
                  <span>회원가입</span>
                </a>
              </p>
              <p class="text-center">
                <span>Copyright © 2022 XOR파이 All Right Reserved.</span><br>
                {$today} - {$service_mode}
              </p> 
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./library/sneat-1.0.0/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./library/sneat-1.0.0/assets/vendor/libs/popper/popper.js"></script>
    <script src="./library/sneat-1.0.0/assets/vendor/js/bootstrap.js"></script>
    <script src="./library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="./library/sneat-1.0.0/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="./library/sneat-1.0.0/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="./library/button/buttons.js"></script>
  </body>
</html>

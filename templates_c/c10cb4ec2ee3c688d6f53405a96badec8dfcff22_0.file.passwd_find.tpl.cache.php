<?php
/* Smarty version 4.1.1, created on 2022-09-10 15:00:21
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\member\passwd_find.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c27f5b3e7d0_83593626',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c10cb4ec2ee3c688d6f53405a96badec8dfcff22' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\member\\passwd_find.tpl',
      1 => 1662789614,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631c27f5b3e7d0_83593626 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '143150801631c27f5b36246_25891272';
?>
<!DOCTYPE html>
<html lang="ko"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../library/sneat-1.0.0/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../icon/small_logo.ico" />

    <!-- Fonts -->
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/css/smart_premiere.css.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/js/helpers.js"><?php echo '</script'; ?>
>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/js/config.js"><?php echo '</script'; ?>
>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- 비밀번호 분실 -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <img src="../../images/small_logo.png" alt="로고">
              <!-- /Logo -->
              <h4 class="mb-2">비밀번호를 잊어버리셨나요? 🔒</h4>
              <p class="mb-4">이메일을 입력하면 임시 비밀번호를 보내드립니다.</p>
              
                <form method="POST" class="mb-3" action="passwd_find">
                <input type="hidden" name="func" value="passwd_find">
                <input type="hidden" name="srtype" value="submit">
                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['passwd_find_token']->value;?>
">
                
                <div class="mb-3">
                  <label for="usrname" class="form-label">성명</label>
                  <input
                    type="text"
                    class="form-control"
                    id="usrname"
                    name="usrname"
                    placeholder="성명을 입력하세요."
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="이메일 주소를 입력하세요."
                    autofocus
                  />
                </div>
                <button class="btn btn-primary d-grid w-100">비밀번호 찾기</button>
              </form>
              <div class="text-center">
                <a href="../../" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  로그인으로 돌아가기
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/libs/jquery/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/libs/popper/popper.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/js/bootstrap.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/js/menu.js"><?php echo '</script'; ?>
>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/js/main.js"><?php echo '</script'; ?>
>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <?php echo '<script'; ?>
 async defer src="../../library/button/buttons.js"><?php echo '</script'; ?>
>
  </body>
</html>
<?php }
}

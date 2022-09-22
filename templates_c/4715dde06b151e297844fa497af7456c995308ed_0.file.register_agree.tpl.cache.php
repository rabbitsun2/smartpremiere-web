<?php
/* Smarty version 4.1.1, created on 2022-09-22 15:03:05
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\member\register_agree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_632bfa998e5502_81355880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4715dde06b151e297844fa497af7456c995308ed' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\member\\register_agree.tpl',
      1 => 1663826582,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632bfa998e5502_81355880 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1903797763632bfa998dfb17_80841390';
?>
<!DOCTYPE html>
<html lang="ko" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="../../library/sneat-1.0.0/assets" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

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
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/css/smart_premiere.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../library/sneat-1.0.0/assets/vendor/css/pages/page-auth-register-agree.css" />
    <!-- Helpers -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/js/helpers.js"><?php echo '</script'; ?>
>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/js/config.js"><?php echo '</script'; ?>
>


    <!-- jquery_min -->
    <?php echo '<script'; ?>
 src="../../library/jquery/1.12.4/jquery.min.js"><?php echo '</script'; ?>
>


    <?php echo '<script'; ?>
>
      $(document).ready(function(){
        
        $("#check_all").click(function(){

          var cnt_require = $("input[name=require_agree]:checkbox:checked").length;
          var cnt_option = $("input[name=option_agree]:checkbox:checked").length;

          var cnt_result = cnt_require + cnt_option;

          if ( cnt_result < 2 ){
            $("input[name=require_agree]").prop("checked", true);
            $("input[name=option_agree]").prop("checked", true);
          }else if ( cnt_result == 2 ){
            $("input[name=require_agree]").prop("checked", false);
            $("input[name=option_agree]").prop("checked", false);
          }
        });

      });
    <?php echo '</script'; ?>
>
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
              <img src="../../images/small_logo.png" alt="로고">
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to Smart Premiere!</h4>
              <p class="mb-5"> 사용자 등록 </p>

                <form method="POST" action="register_agree">
                <input type="hidden" name="func" value="agree">
                <input type="hidden" name="srtype" value="submit">
              
              <div class="mb-3">
                  <!-- 전체 동의 -->
                  <div class="card">
                    <h6 class="card-header"> 전체동의 
                      <input class="form-check-input" type="checkbox" value="" id="check_all" />
                    </h6>
                  </div>
              </div>

                <div class="mb-3">
                  <!-- 환영합니다 -->
                  <div class="col-md-15">
                    <div class="card overflow-hidden mb-4" style="height: 160px">
                      <div class="card-body" id="vertical-example">
                        <p>
                          스마트 프리미어 솔루션(Smart Premiere Solution)을 사용하시는 것에 대해서 진심으로 환영합니다.<br>
                          스마트 프리미어(이하 "SW프로그램")는 최초 회원 가입 또는 서비스 이용시 이용자로부터 아래와 같은 개인정보를 수집하고 있습니다.<br>
                          이용자는 본 개인정보 수집·이용 동의서에 따른 동의 시, '필요한 최소한의 정보 외의 개인정보' 수집·이용에 동의하지 아니할 권리가 있습니다.<br>
                          개인정보 처리에 대한 상세한 사항은 하단의 홈페이지에 공개한 '개인정보 처리방침'을 참조하십시오.<br>
                          다만, 본 동의서 내용과 상충되는 부분은 본 동의서의 내용이 우선합니다.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!--/ 환영합니다 -->
                  </div>
                <div class="mb-3">
                  <!-- 필수 동의 -->
              <div class="card">
                <h6 class="card-header"> 동의함 <input type="checkbox" name="require_agree" class="form-check-input">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보 수집·이용 동의(필수)</h6>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width:15%">구분</th>
                        <th style="width:35%">수집항목</th>
                        <th style="width:35%">수집목적</th>
                        <th>보유기간</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>
                          필수 항목
                        </td>
                        <td>
                          성명, 이메일
                        </td>
                        <td>
                          	- 개인정보 처리 및 <br>
                              정보주체의 개인정보 열람, <br>
                              정정 삭제 요구시 본인확인<br>
                            - 시스템 내 접근
                        </td>
                        <td>
                          <span class="badge bg-label-primary me-1">시스템 내 영구</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ 필수 동의 Table -->
                </div>
                <div class="mb-3">
                  위 개인정보 수집·이용에 동의합니다(필수)<br><br>
                </div>
                <div class="mb-3">
                  ※ 귀하께서는 필수항목 수집·이용에 대한 동의를 거부하실 수 있으나,이는 서비스 제공에<br>
                  필수적으로 제공되어야 하는 정보이므로, 동의를 거부하실 경우 서비스 이용을 <br>하실 수 없습니다.
                </div>
                
                <!-- 선택 동의 -->
              <div class="card">
                <h6 class="card-header"> 동의함 <input type="checkbox" name="option_agree" class="form-check-input">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;개인정보 수집·이용 동의(선택)</h6>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width:15%">구분</th>
                        <th style="width:35%">수집항목</th>
                        <th style="width:35%">수집목적</th>
                        <th>보유기간</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>
                          선택 항목
                        </td>
                        <td>
                          해당없음
                        </td>
                        <td>
                          	- 해당없음
                        </td>
                        <td>
                          <span class="badge bg-label-info me-1">수집 목적 상실 후 <br>즉시 폐기</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ 선택 동의 Table -->
                <div class="mb-3">
                  위 개인정보 수집·이용에 동의합니다(선택)
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">다음</button>
                </div>
              </form>
              <p class="text-center">
                <span>이미 계정을 가지고 계시나요?</span>
                <a href="../..">
                  <span>로그인</span>
                </a>
              </p>
              </p>
              <p class="text-center">
                <span>Copyright © 2022 XOR파이 All Right Reserved.</span><br>
                <?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['service_mode']->value;?>

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
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"><?php echo '</script'; ?>
>

    <!-- Main JS -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/js/main.js"><?php echo '</script'; ?>
>

    <!-- Page JS -->
    <?php echo '<script'; ?>
 src="../../library/sneat-1.0.0/assets/js/extended-ui-perfect-scrollbar.js"><?php echo '</script'; ?>
>

    <!-- Place this tag in your head or just before your close body tag. -->
    <?php echo '<script'; ?>
 async defer src="../../library/button/buttons.js"><?php echo '</script'; ?>
>
  </body>
</html><?php }
}

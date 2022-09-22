<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:29:24
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\menu_account_auth.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631848542d9d70_58556936',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a14c2179e5825381e1a26ab0108d01eb28df7b40' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\menu_account_auth.tpl',
      1 => 1662201482,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631848542d9d70_58556936 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '844982511631848542ca3a6_10858646';
?>
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
            <li class="menu-item">
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

            <!-- 제조/물류 -->
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
            <li class="menu-item active open">
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
        </aside><?php }
}

<html>
<head>
	<title>{$title}</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../css/style_main.css">
	<link rel="stylesheet" href="../../css/style_config.css">
	<link rel="stylesheet" href="../../library/c3/c3.css">
	<script src="../../library/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../library/c3/c3.js"></script>
	<script src="../../library/d3/d3.v5.min.js"></script>
	
	<link rel="stylesheet" href="../../library/jquery-ui-1.13.1.custom/jquery-ui.css">
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
	<script src="../../library/jquery-ui-1.13.1.custom/jquery-ui.js"></script>
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">
</head>
<body>
	<table class="smart_main_tbl">
		<!-- 상단 -->
		<tr>
			<td style="width:20%">
				<!-- 로고 -->
				<table style="width:100%;">
					<tr>
						<td style="width:30%; text-align:center;">
							<img src="../../images/logo.png" width="40%" height="40%" alt="로고">
						</td>
						<td>
							<div class="txt_Logo">스마트 물류 관리 시스템</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="txt_Mode">[운영 / 개발]</div>
						</td>
					</tr>
				</table>
			</td>
			<td style="text-align:right">
				{$session_auth_name} / {$session_usrname}님 <a href="../../index.php/member/logout">로그아웃</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="menu_bar">
				<ul>
					<li>
						<a href="main">메인</a>
					</li>
					<li>
						<a href="config">설정</a>
					</li>
				</ul>
			</td>
		</tr>
		<!-- 본문 -->
		<tr>
			<td class="sub_menu">
				<ul>
					<li>
						<div class="sub_title">1. 계정</div>
						<ul>
							<li>
								<div class="sub_m1">
									<a href="member?func=register">사용자 등록</a>
								</div>
							</li>
							<li>
								<div class="sub_m1">
									<a href="member?func=list">사용자 관리</a>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<div class="sub_title">2. 권한</div>
						<ul>
							<li>
								<div class="sub_m1">
									<a href="member_auth?func=register">권한 등록</a>
								</div>
							</li>
							<li>
								<div class="sub_m1">
									<a href="member_auth?func=list">권한 관리</a>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<div class="sub_title">3. 장비</div>
						<ul>
							<li>
								<div class="sub_m1">
									<a href="machine?func=register">장비 등록</a>
								</div>
							</li>
							<li>
								<div class="sub_m1">
									<a href="machine?func=list">장비 관리</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</td>
			
			<td class="main" style="border:1px solid #e2e2e2;vertical-align:top;">
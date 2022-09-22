<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
	
	<script src="../../library/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="../../library/jquery-ui-1.13.1.custom/jquery-ui.css">
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
	<script src="../../library/jquery-ui-1.13.1.custom/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../css/style_setup.css">
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">

</head>
<body>
    
    <div align="center">
        <h3 class="sub_title">Smart Logistics - 환영합니다 !!!</h3>
        <hr class="sub_hr">
    </div>
    <br>
    <form method="POST" action="hello">
    <input type="hidden" name="func" value="input">
    <input type="hidden" name="srtype" value="submit">

    <table class="ck_agreement">
        <tr>
            <td class="head">
                환영합니다.
            </td>
        </tr>
        <tr>
            <td>
                <span class="ck_agreement_font">
                스마트 로지스틱스 솔루션(Smart Logistics Solution)을 사용하시는 것에 대해서 진심으로 환영합니다.<br>
                스마트 로지스틱스(이하 "SW프로그램")는 최초 회원 가입 또는 서비스 이용시 이용자로부터 아래와 같은 개인정보를 수집하고 있습니다.<br>
                이용자는 본 개인정보 수집·이용 동의서에 따른 동의 시, '필요한 최소한의 정보 외의 개인정보' 수집·이용에 동의하지 아니할 권리가 있습니다.<br>
                개인정보 처리에 대한 상세한 사항은 하단의 홈페이지에 공개한 '개인정보 처리방침'을 참조하십시오.<br>
                다만, 본 동의서 내용과 상충되는 부분은 본 동의서의 내용이 우선합니다.<br><br>
                </span>
            </td>
        <tr>
        <tr>
            <td>
                □ 개인정보 수집·이용 동의(필수)
                <br>
                <!-- 필수 동의(Agreement) -->
                <table class="ck_agreement_notice_tbl">
                    <tr>
                        <td colspan="4" class="head_border">
                        </td>
                    </tr>
                    <tr>
                        <td class="head" style="width:10%">
                            구분
                        </td>
                        <td class="head" style="width:35%">
                            수집항목
                        </td>
                        <td class="head" style="width:35%">
                            수집목적
                        </td>
                        <td class="head">
                            보유기간
                        </td>
                    </tr>
                    <tr>
                        <td>
                            필수항목
                        </td>
                        <td>
                            성명, 이메일
                        </td>
                        <td>
                            - 개인정보 처리 및 정보주체의 <br>
                            &nbsp;&nbsp;&nbsp;개인정보 열람, 정정, <br>
                            &nbsp;&nbsp;&nbsp;삭제 요구시 본인확인<br>
                            - 시스템 내 접근
                        </td>
                        <td>
                            시스템 내 영구
                        </td>
                    </tr>
                </table>
                <br>
                위 개인정보 수집·이용에 동의합니다(필수)   동의함 <input type="checkbox" name="require_agree"> 
            </td>
        <tr>
        <tr>
            <td>
                <br>
                <span class="ck_agreement_font">
                ※ 귀하께서는 필수항목 수집·이용에 대한 동의를 거부하실 수 있으나,이는 서비스 제공에 필수적으로 
                제공되어야 하는 정보이므로, <br>동의를 거부하실 경우 서비스 이용을 하실 수 없습니다.<br><br>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                □ 개인정보 수집·이용 동의(선택)<br>
                <!-- 필수 동의(Agreement) -->
                <table class="ck_agreement_notice_tbl">
                    <tr>
                        <td colspan="4" class="head_border">
                        </td>
                    </tr>
                    <tr>
                        <td class="head" style="width:10%">
                            구분
                        </td>
                        <td class="head" style="width:35%">
                            수집항목
                        </td>
                        <td class="head" style="width:35%">
                            수집목적
                        </td>
                        <td class="head">
                            보유기간
                        </td>
                    </tr>
                    <tr>
                        <td>
                            선택항목
                        </td>
                        <td>
                            해당없음
                        </td>
                        <td>
                            - 해당없음
                        </td>
                        <td>
                            수집 목적 상실 후 <br>즉시 폐기
                        </td>
                    </tr>
                </table>
                <br>
                위 개인정보 수집·이용에 동의합니다(선택)   동의함 <input type="checkbox" name="option_agree"> 
            </td>
        </tr>
    </table>
    
    <!-- 사용자 입력 항목 -->
    <table class="ck_input_agreement_tbl">
        <tr>
            <td>
                <!-- 입력 항목 -->
                <table class="ck_input_agreement_detail_tbl">
                    <tr>
                        <td>이메일 주소</td>
                        <td>
                            <input type="text" name="email" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>성명</td>
                        <td>
                            <input type="text" name="usrname" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>비밀번호</td>
                        <td>
                            <input type="password" name="passwd1" style="width:100%">
                        </td>
                    </tr>
                    <tr>
                        <td>비밀번호 확인</td>
                        <td>
                            <input type="password" name="passwd2" style="width:100%">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="등록" style="width:20%;">
    </div>
    <br>
    </form>
</body>
</html>
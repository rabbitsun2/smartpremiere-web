<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색 결과 - 프로젝트 코드 찾기</title>
	
	<script src="../../library/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="../../library/jquery-ui-1.13.1.custom/jquery-ui.css">
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
	<script src="../../library/jquery-ui-1.13.1.custom/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../css/style_product_pjtSearch.css">

    <script type="text/javascript">
        function setParentText(num){
            //alert( '참' );
            //alert( document.getElementById("cProject_name_" + num).value );
            opener.document.getElementById("pInput_project_id").value = document.getElementById("cProject_id_" + num).value;
            opener.document.getElementById("pInput_project_name").value = document.getElementById("cProject_name_" + num).value;
            
        }
    </script>

</head>
<body>
    
    <h3 class="sub_title">프로젝트 검색</h3>
    <hr class="sub_hr">
    <br>
    <a href="javascript:history.back()">이전으로</a>
    <table class="ck_input_result_tbl">
        <tr>
            <td style="width:15%" class="head">
                프로젝트 번호
            </td>
            <td class="head">
                프로젝트명
            </td>
        </tr>
        {foreach $projectList as $projectitem}
        <tr>
            <td>
                <input type="hidden" id="cProject_id_{$projectitem.project_id}" value="{$projectitem.project_id}">
                {$projectitem.project_id}
            </td>
            <td>
                <input type="hidden" id="cProject_name_{$projectitem.project_id}" value="{$projectitem.project_name}">
                <a href="#" onclick="setParentText({$projectitem.project_id})">{$projectitem.project_name}</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="ck_input_result_detail_tbl">
                    <tr>
                        <td style="background-color:#e2e2e2;">
                             시작일자
                        </td>
                        <td style="background-color:#e2e2e2;">
                             종료일자
                        </td>
                        <td style="background-color:#e2e2e2;">
                             등록일자
                        </td>
                    </tr>
                    <tr>
                        <td>
                             {$projectitem.startdate}
                        </td>
                        <td>
                             {$projectitem.enddate}
                        </td>
                        <td>
                             {$projectitem.regidate}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        {/foreach}
    </table>
    
    <!-- 페이징 영역 -->
    <div style="text-align:center;">
    {include file="paging_old.tpl"}
    <br>
    
    <input type="button" value="창닫기" onclick="window.close()">
    </div>

    <!--
    <br><br>
        <input type="text" id="cInput">
            <input type="button" value="전달하기" onclick="setParentText()">
    <br><br>
    -->


</body>
</html>
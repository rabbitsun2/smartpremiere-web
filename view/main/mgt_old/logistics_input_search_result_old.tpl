<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>검색 결과 - 품목 코드 찾기</title>
	
	<script src="../../library/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="../../library/jquery-ui-1.13.1.custom/jquery-ui.css">
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
	<script src="../../library/jquery-ui-1.13.1.custom/jquery-ui.js"></script>
	<link rel="stylesheet" href="../../css/style_inputSearch.css">

    <script type="text/javascript">
        
        var openWin;

		function openChild(id){

			var popupWidth = 680;
			var popupHeight = 350;

			var popupX = (window.screen.width / 2) - (popupWidth / 2);
			// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

			var popupY= (window.screen.height / 2) - (popupHeight / 2);
			// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

	    	// window.name = "부모창 이름";
			window.name = "parentForm";
			// window.open("open할 window", "자식창 이름", "팝업창 옵션");
			openWin = window.open("product?func=list&id=" + id + "&option=detail_view" ,
		        "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
				"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
		}

        function setParentText(num){
            opener.document.getElementById("pInput_productCode").value = document.getElementById("cProduct_id_" + num).value
            opener.document.getElementById("pInput_productName").value = document.getElementById("cProduct_name_" + num).value
        }

	</script>

</head>
<body>
    
    <h3 class="sub_title">품목 검색</h3>
    <hr class="sub_hr">
    <br>
    <a href="javascript:history.back()">이전으로</a>
    <table class="ck_input_result_tbl">
        <tr>
            <td style="width:10%" class="head">
                품목코드
            </td>
            <td style="width:20%" class="head">
                품목명
            </td>
            <td style="width:25%" class="head">
                설명
            </td>
            <td class="head">
                기능
            </td>
            <td style="width:15%" class="head">
                등록일자
            </td>
        </tr>
        {foreach $productList as $productitem}
        <tr>
            <td>
                <input type="hidden" id="cProduct_id_{$productitem.product_id}" value="{$productitem.product_id}">
                {$productitem.product_id}
            </td>
            <td>
                <input type="hidden" id="cProduct_name_{$productitem.product_id}" value="{$productitem.product_name}">
                <a href="#" onclick="setParentText({$productitem.product_id})">{$productitem.product_name}</a>
            </td>
            <td>
                {$productitem.description}
            </td>
            <td>
                <a href="#" onclick="openChild({$productitem.product_id})">상세보기</a>
            </td>
            <td>
                {$productitem.regidate}
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
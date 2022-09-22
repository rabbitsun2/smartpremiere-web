{include file="header.tpl"}

<script type="text/javascript">
    var openWin;
    function openChild(){

        var popupWidth = 950;
        var popupHeight = 500;

        var popupX = (window.screen.width / 2) - (popupWidth / 2);
        // 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

        var popupY= (window.screen.height / 2) - (popupHeight / 2);
        // 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

        // window.name = "부모창 이름";
        window.name = "parentForm";
        // window.open("open할 window", "자식창 이름", "팝업창 옵션");
        openWin = window.open("product?func=input&search=project",
            "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
            "left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
    }
</script>

<h3 class="sub_title">프로젝트(제품)/제품 등록</h3>
<hr class="sub_hr">
<form action="product?func=register" method="POST" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
<input type="hidden" name="func" value="input">
<input type="hidden" name="srtype" value="submit">
<table class="product_register_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">프로젝트 번호</td>
        <td style="width:50%;">
            <input type="text" id="pInput_project_id" name="project_id" style="width:90%;" readonly>
        </td>  
        <td>
            <input class="ui-button ui-widget ui-corner-all" type="button" 
                value="찾기" onclick="openChild()">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">프로젝트 명</td>
        <td colspan="2">
            <input type="text" id="pInput_project_name" name="project_name" style="width:90%;" readonly>
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">제품명</td>
        <td colspan="2">
            <input type="text" name="product_name" style="width:90%;">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">설명</td>
        <td colspan="2">
            <textarea class="form-control"  name="description" rows="5" cols="35"></textarea>
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">파일1</td>
        <td colspan="2">
            <input type="file" name="usrupload[]" style="width:90%;" multiple="multiple">
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="등록" style="width:90%;">
        </td>
    </tr>
</table>
</form>
				
{include file="footer.tpl"}
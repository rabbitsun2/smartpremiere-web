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

<h3 class="sub_title">프로젝트(제품)/제품 수정</h3>
<hr class="sub_hr">
<form action="product?func=modify" method="POST" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
{section name=usr_item1 loop=$product_item}
<input type="hidden" name="cur_project_id" value="{$product_item[usr_item1].project_id}">
<input type="hidden" name="cur_product_id" value="{$product_item[usr_item1].product_id}">
<input type="hidden" name="func" value="modify">
<input type="hidden" name="srtype" value="submit">
<table class="product_modify_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">프로젝트 번호</td>
        <td style="width:50%;">
            <input type="text" id="pInput_project_id" name="project_id" style="width:90%;" readonly value="{$product_item[usr_item1].project_id}">
        </td>  
        <td>
            <input class="ui-button ui-widget ui-corner-all" type="button" 
                value="찾기" onclick="openChild()">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">프로젝트 명</td>
        <td colspan="2">
            <input type="text" id="pInput_project_name" name="project_name" style="width:90%;" readonly value="{$product_item[usr_item1].project_name}">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">제품명</td>
        <td colspan="2">
            <input type="text" name="product_name" style="width:90%;" value="{$product_item[usr_item1].product_name}">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">설명</td>
        <td colspan="2">
            <textarea name="description" rows="5" cols="35">{$product_item[usr_item1].description}</textarea>
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
					value="수정" style="width:90%;">
        </td>
    </tr>
</table>
{/section}
</form>


<h3 class="sub_title">파일 목록</h3>
<hr class="sub_hr">

<table class="product_modify_tbl">
    {section name=usr_item2 loop=$product_file_item}
    <tr>
        <td style="width:10%; background:#e2e2e2;">파일</td>
        <td>
            <a href="product?func=download&uuid={$product_file_item[usr_item2].uuid}">{$product_file_item[usr_item2].original_name}</a> / ({$product_file_item[usr_item2].file_size})
        </td>
        <td style="width:10%;">
            <a href="product?func=download&uuid={$product_file_item[usr_item2].uuid}&product_id={$product_file_item[usr_item2].product_id}&page=delete">삭제</a>
        </td>
    </tr>
    {/section}
</table>

{include file="footer.tpl"}
{include file="header.tpl"}
<h3 class="sub_title">장비/수정</h3>
<hr class="sub_hr">
<form action="machine?func=delete" method="POST">
{section name=item_val loop=$machine_item}
<input type="hidden" name="id" value="{$machine_item[item_val].id}">
<input type="hidden" name="uuid" value="{$machine_item[item_val].uuid}">
<input type="hidden" name="func" value="delete">
<input type="hidden" name="srtype" value="submit">

<table class="machine_delete_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">장치명</td>
        <td>{$machine_item[item_val].machine_name}</td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">UUID</td>
        <td>
            {$machine_item[item_val].uuid}
        </td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">메모</td>
        <td>
            {$machine_item[item_val].memo}
        </td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">상태</td>
        <td>
            {$machine_item[item_val].locked}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            정말로 삭제하시겠습니까?
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="삭제" style="width:90%;">
        </td>
    </tr>
</table>
{/section}
</form>
				
{include file="footer.tpl"}
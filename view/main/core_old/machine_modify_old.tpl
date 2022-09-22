{include file="header.tpl"}
<h3 class="sub_title">장비/수정</h3>
<hr class="sub_hr">
<form action="machine?func=modify" method="POST">
{section name=item_val loop=$machine_item}
<input type="hidden" name="machine_id" value="{$machine_item[item_val].machine_id}">
<input type="hidden" name="uuid" value="{$machine_item[item_val].uuid}">
<input type="hidden" name="func" value="modify">
<input type="hidden" name="srtype" value="submit">

<table class="machine_modify_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">장치명</td>
        <td><input type="text" name="machine_name" style="width:90%;" value="{$machine_item[item_val].machine_name}"></td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">UUID</td>
        <td>
            {$machine_item[item_val].uuid}
        </td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">메모</td>
        <td><input type="text" name="memo" maxlength="50" style="width:90%;" value="{$machine_item[item_val].memo}"></td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">상태</td>
        <td>
            <select name="locked" style="width:90%;">
                <option value="{$machine_item[item_val].locked}">{$machine_item[item_val].locked}</option>
                <option value="활성">활성</option>
                <option value="비활성">비활성</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="수정" style="width:90%;">
        </td>
    </tr>
</table>
{/section}
</form>
				
{include file="footer.tpl"}
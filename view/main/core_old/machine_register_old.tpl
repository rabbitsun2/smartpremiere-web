{include file="header.tpl"}
<h3 class="sub_title">장비/등록</h3>
<hr class="sub_hr">
<form action="machine?func=register" method="POST">
<input type="hidden" name="func" value="input">
<input type="hidden" name="srtype" value="submit">
<table class="machine_register_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">장치명</td>
        <td><input type="text" name="machine_name" style="width:90%;"></td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">메모</td>
        <td><input type="text" name="memo" maxlength="50" style="width:90%;"></td>
    </tr>
    <tr>
        <td style="width:30%;background:#e2e2e2;">상태</td>
        <td>
            <select name="locked" style="width:90%;">
                <option value="활성">활성</option>
                <option value="비활성">비활성</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="등록" style="width:90%;">
        </td>
    </tr>
</table>
</form>
				
{include file="footer.tpl"}
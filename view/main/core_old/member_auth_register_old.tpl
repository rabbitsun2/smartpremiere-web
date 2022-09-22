{include file="header.tpl"}
<h3 class="sub_title">권한/등록</h3>
<hr class="sub_hr">
<form action="member_auth?func=register" method="POST">
<input type="hidden" name="func" value="input">
<input type="hidden" name="srtype" value="submit">
<table class="member_auth_register_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">권한명</td>
        <td><input type="text" name="auth_name" style="width:90%;"></td>
    </tr>
    
    <tr>
        <td style="width:30%;background:#e2e2e2;">권한 현황</td>
        <td>
            <select style="width:90%;">
            {section name=item_val loop=$member_auth_list}
                <option value="{$member_auth_list[item_val].id}">{$member_auth_list[item_val].auth_name}</option>
            {/section}
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
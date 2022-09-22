{include file="header.tpl"}
<h3 class="sub_title">권한/수정</h3>
<hr class="sub_hr">
<form action="member_auth?func=modify" method="POST">
{section name=item_val1 loop=$member_auth_item}
<input type="hidden" name="id" value="{$member_auth_item[item_val1].id}">
<input type="hidden" name="func" value="modify">
<input type="hidden" name="srtype" value="submit">
<table class="member_auth_modify_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">권한명</td>
        <td><input type="text" name="auth_name" style="width:90%;" value="{$member_auth_item[item_val1].auth_name}"></td>
    </tr>
    {/section}
    <tr>
        <td style="width:30%;background:#e2e2e2;">권한 현황</td>
        <td>
            <select style="width:90%;">
            {section name=item_val2 loop=$member_auth_list}
                <option value="{$member_auth_list[item_val2].id}">{$member_auth_list[item_val2].auth_name}</option>
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
{include file="header.tpl"}
<h3 class="sub_title">계정/사용자 삭제</h3>
<hr class="sub_hr">
{section name=usr_auth_item loop=$member_item}
<form action="member?func=delete" method="POST">
<input type="hidden" name="idx" value="{$member_item[usr_auth_item].member_id}">
<input type="hidden" name="email" value="{$member_item[usr_auth_item].email}">
<input type="hidden" name="func" value="delete">
<input type="hidden" name="srtype" value="submit">
<table class="member_delete_tbl">
    <tr>
        <td style="width:40%;background:#e2e2e2;">이메일</td>
        <td>
            {$member_item[usr_auth_item].email}
        </td>
    </tr>
    <tr>
        <td style="width:40%;background:#e2e2e2;">권한</td>
        <td>
            {$member_item[usr_auth_item].auth_name}
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">성명</td>
        <td>{$member_item[usr_auth_item].usrname}</td>
    </tr>
    <tr>
        <td colspan="2">정말로 삭제하시겠습니까?</td>
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
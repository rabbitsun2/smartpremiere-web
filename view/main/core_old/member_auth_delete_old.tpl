{include file="header.tpl"}
<h3 class="sub_title">권한/삭제</h3>
<hr class="sub_hr">
<form action="member_auth?func=delete" method="POST">
{section name=item_val1 loop=$member_auth_item}
<input type="hidden" name="id" value="{$member_auth_item[item_val1].id}">
<input type="hidden" name="func" value="delete">
<input type="hidden" name="srtype" value="submit">
<table class="member_auth_delete_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">권한명</td>
        <td>{$member_auth_item[item_val1].auth_name}</td>
    </tr>
    {/section}
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
</form>
				
{include file="footer.tpl"}
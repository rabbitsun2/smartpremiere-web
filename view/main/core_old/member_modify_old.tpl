{include file="header.tpl"}
<h3 class="sub_title">계정/사용자 수정</h3>
<hr class="sub_hr">
<form action="member?func=modify" method="POST">
{section name=usr_auth_item loop=$member_item}
<input type="hidden" name="idx" value="{$member_item[usr_auth_item].member_id}">
<input type="hidden" name="email" value="{$member_item[usr_auth_item].email}">
{/section}
<input type="hidden" name="func" value="modify">
<input type="hidden" name="srtype" value="submit">
<table class="member_modify_tbl">
    <tr>
        <td style="width:40%;background:#e2e2e2;">권한</td>
        <td>
            <select name="member_auth" style="width:90%;">
            {section name=usr_auth_item loop=$member_item}
                <option value="{$member_item[usr_auth_item].member_auth}">{$member_item[usr_auth_item].auth_name}</option>
            {/section}
            {section name=member_auth loop=$member_auth_list}
                <option value="{$member_auth_list[member_auth].id}">{$member_auth_list[member_auth].auth_name}</option>
            {/section}
            </select>
        </td>
    </tr>
    
    {section name=usr_auth_item loop=$member_item}
    <tr>
        <td style="background:#e2e2e2;">이메일</td>
        <td>{$member_item[usr_auth_item].email}</td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">성명</td>
        <td><input type="text" name="usrname" style="width:90%;" value="{$member_item[usr_auth_item].usrname}"></td>
    </tr>
    {/section}
    <tr>
        <td style="background:#e2e2e2;">신규 비밀번호</td>
        <td><input type="password" name="passwd1" style="width:90%;"></td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">신규 비밀번호 확인</td>
        <td><input type="password" name="passwd2" style="width:90%;"></td>
    </tr>
    <tr>
        <td style="width:40%;background:#e2e2e2;">상태</td>
        <td>
            <select name="locked" style="width:90%;">
            {section name=usr_locked_item loop=$member_item}
                <option value="{$member_item[usr_locked_item].locked}">{$member_item[usr_locked_item].locked}</option>
            {/section}
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
</form>
				
{include file="footer.tpl"}
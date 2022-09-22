{include file="header.tpl"}
<h3 class="sub_title">프로젝트 수정</h3>
<hr class="sub_hr">
<form action="project?func=modify" method="POST" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
{section name=usr_item1 loop=$project_item}
<input type="hidden" name="project_id" value="{$project_item[usr_item1].project_id}">
<input type="hidden" name="func" value="modify">
<input type="hidden" name="srtype" value="submit">
<table class="project_modify_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">프로젝트명</td>
        <td>
            <input type="text" name="project_name" style="width:90%;" value="{$project_item[usr_item1].project_name}">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">설명</td>
        <td>
            <textarea name="description" style="width:90%;">{$project_item[usr_item1].description}</textarea>
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">시작일자</td>
        <td><input type="datetime-local" name="startdate" style="width:90%;" value="{$project_item[usr_item1].startdate}"></td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">종료일자</td>
        <td><input type="datetime-local" name="enddate" style="width:90%;" value="{$project_item[usr_item1].enddate}"></td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">파일1</td>
        <td><input type="file" name="usrupload[]" style="width:90%;" multiple="multiple"></td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">파일2</td>
        <td><input type="file" name="usrupload[]" style="width:90%;" multiple="multiple"></td>
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
<br>

<h3 class="sub_title">파일 목록</h3>
<hr class="sub_hr">

<table class="project_modify_tbl">
    {section name=usr_item2 loop=$project_file_item}
    <tr>
        <td style="width:10%; background:#e2e2e2;">파일</td>
        <td>
            <a href="project?func=download&uuid={$project_file_item[usr_item2].uuid}">{$project_file_item[usr_item2].original_name}</a> / ({$project_file_item[usr_item2].file_size})
        </td>
        <td style="width:10%;">
            <a href="project?func=download&uuid={$project_file_item[usr_item2].uuid}&project_id={$project_file_item[usr_item2].project_id}&page=delete">삭제</a>
        </td>
    </tr>
    {/section}
</table>
				
{include file="footer.tpl"}
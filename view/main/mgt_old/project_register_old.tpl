{include file="header.tpl"}
<h3 class="sub_title">프로젝트 등록</h3>
<hr class="sub_hr">
<form action="project?func=register" method="POST" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
<input type="hidden" name="func" value="input">
<input type="hidden" name="srtype" value="submit">
<table class="project_register_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">프로젝트명</td>
        <td>
            <input type="text" name="project_name" style="width:90%;">
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">설명</td>
        <td>
            <textarea name="description" style="width:90%;"></textarea>
        </td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">시작일자</td>
        <td><input type="datetime-local" name="startdate" style="width:90%;"></td>
    </tr>
    <tr>
        <td style="background:#e2e2e2;">종료일자</td>
        <td><input type="datetime-local" name="enddate" style="width:90%;"></td>
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
					value="등록" style="width:90%;">
        </td>
    </tr>
</table>
</form>
				
{include file="footer.tpl"}
{include file="header.tpl"}
<h3 class="sub_title">프로젝트 파일 삭제</h3>
<hr class="sub_hr">

<script type="text/javascript">
    
    function goHistoryBack(id){
        location.replace('project?func=modify&id=' + id );
    }
</script>

<form action="project?func=modify" method="POST" enctype="multipart/form-data">

{section name=usr_item1 loop=$project_file_item}
<input type="hidden" name="project_id" value="{$project_file_item[usr_item1].project_id}">
<input type="hidden" name="uuid" value="{$project_file_item[usr_item1].uuid}">
<input type="hidden" name="func" value="file_delete">
<input type="hidden" name="srtype" value="submit">
<table class="project_delete_file_tbl">
    <tr>
        <td style="width:30%;background:#e2e2e2;">{$project_file_item[usr_item1].original_name}</td>
    </tr>
    <tr>
        <td>
            <span>정말로 삭제하시겠습니까?</span>
        </td>
    </tr>
    <tr>
        <td>
            <input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="삭제" style="width:45%;">
            <a class="ui-button ui-widget ui-corner-all btn_submit"
                 onclick="goHistoryBack('{$project_file_item[usr_item1].project_id}')"
                 style="width:40%;">이전</a>
        </td>
    </tr>
</table>
{/section}
</form>

				
{include file="footer.tpl"}
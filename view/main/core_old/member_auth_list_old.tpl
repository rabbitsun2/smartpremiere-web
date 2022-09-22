{include file="header.tpl"}
<h3 class="sub_title">권한/관리</h3>
<hr class="sub_hr">

<!-- 결과 -->
<table class="output_result_tbl">
	<thead>
		<tr>
			<th style="width:7%">
				번호
			</th>
			<th>
				권한명
			</th>
			<th style="width:15%">
				비고
			</th>
		</tr>
	</thead>
	<tbody>
		{section name=item_val loop=$memberAuthList}
		<tr>
			<td>
				{$memberAuthList[item_val].id}
			</td>
			<td>
				{$memberAuthList[item_val].auth_name}
			</td>
			<td>
				<a href="member_auth?func=modify&id={$memberAuthList[item_val].id}">수정</a>, 
                <a href="member_auth?func=delete&id={$memberAuthList[item_val].id}">삭제</a>
			</td>
		</tr>
		{/section}
	</tbody>
</table>

<div style="text-align:center;">
<!-- 페이징 영역 -->
{include file="paging.tpl"}
</div>
				
{include file="footer.tpl"}
{include file="header.tpl"}
<h3 class="sub_title">장비/관리</h3>
<hr class="sub_hr">

<!-- 결과 -->
<table class="output_result_tbl">
	<thead>
		<tr>
			<th style="width:7%">
				번호
			</th>
			<th style="width:25%">
				장비명
			</th>
			<th style="width:25%">
				UUID
			</th>
			<th>
				메모
			</th>
			<th style="width:10%">
				상태
			</th>
			<th style="width:10%">
				등록일자
			</th>
			<th style="width:15%">
				비고
			</th>
		</tr>
	</thead>
	<tbody>
		{section name=item_val loop=$machineList}
		<tr>
			<td>
				{$machineList[item_val].machine_id}
			</td>
			<td>
				{$machineList[item_val].machine_name}
			</td>
			<td>
				{$machineList[item_val].uuid}
			</td>
			<td>
				{$machineList[item_val].memo}
			</td>
			<td>
				{$machineList[item_val].locked}
			</td>
			<td>
				{$machineList[item_val].regidate}
			</td>
			<td>
				<a href="machine?func=modify&id={$machineList[item_val].machine_id}">수정</a>, 
                <a href="machine?func=delete&id={$machineList[item_val].machine_id}">삭제</a>
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
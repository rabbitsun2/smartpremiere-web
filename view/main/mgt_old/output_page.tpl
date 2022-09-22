{include file="header.tpl"}
				<h3 class="sub_title">생산/출고</h3>
				<hr class="sub_hr">
<!-- 검색 영역 -->
<form action="factory?func=output" method="GET">
<input type="hidden" name="func" value="output">
<table class="output_search_tbl">
	<tr>
		<td style="width:10%">
			품목명
		</td>
		<td style="width:70%">
			<input type="text" name="keyword" class="smart_input_search">
		</td>
		<td style="width:20%">
			<input type="submit" class="ui-button ui-widget ui-corner-all btn_submit" type="submit"
				value="검색" style="width: 100%;">
		</td>
	</tr>
</table>
</form>


<!-- 결과 -->
<table class="output_result_tbl">
	<thead>
		<tr>
			<th style="width:10%">
				번호
			</th>
			<th style="width:15%">
				프로젝트/품목번호
			</th>
			<th style="width:35%">
				프로젝트명/품목명
			</th>
			<th>
				사진
			</th>
			<th style="width:15%">
				입고일자
			</th>
			<th style="width:10%">
				현재수량
			</th>
			<th style="width:10%">
				비고
			</th>
		</tr>
	</thead>
	<tbody>
		{foreach $warehouseLogList as $w_item}
		<tr>
			<td>
				{$w_item.id}
			</td>
			<td>
				{$w_item.project_no}/{$w_item.w_id}
			</td>
			<td>
				{$w_item.project_name}/{$w_item.product_name}
			</td>
			<td>
				<img src="../../pjt/images/{$w_item.product_no}.png" style="width:120px; height:120px" alt="{$w_item.product_description}">
			</td>
			<td>
				{$w_item.create_date}
			</td>
			<td>
				{$w_item.current_cnt}
			</td>
			<td>
				<a href="factory?func=output&status=release&id={$w_item.id}">출고</a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>

<div style="text-align:center;">
<!-- 페이징 영역 -->
{include file="paging.tpl"}
</div>

{include file="footer.tpl"}
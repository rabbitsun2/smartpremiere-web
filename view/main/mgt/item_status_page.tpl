{include file="header.tpl"}
				<h3 class="sub_title">프로젝트(제품) / 제품 현황</h3>
				<hr class="sub_hr">

<table class="item_status_tbl">
	<thead>
		<tr>
			<th style="width:10%">
				제품번호
			</th>
			<th style="width:15%">
				제품명
			</th>
			<th style="width:35%">
				설명
			</th>
			<th>
				사진
			</th>
			<th>
				등록일자
			</th>
		</tr>
	</thead>
	<tbody>
		{foreach $productList as $u_item}
		<tr>
			<td>
				{$u_item.product_no}
			</td>
			<td>
				{$u_item.product_name}
			</td>
			<td>
				{$u_item.description}
			</td>
			<td>
				<img src="../../pjt/images/{$u_item.product_no}.png" alt="{$u_item.description}" style="width:120px;height:120px;">
			</td>
			<td>
				{$u_item.regidate}
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
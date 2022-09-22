{include file="header.tpl"}
				<h3 class="sub_title">물류/출고 - 출고 작업</h3>
				<hr class="sub_hr">
<!-- 검색 영역 -->
{foreach $warehouse_rows as $w_item}
<form action="logistics?func=output&status=w_ok&id={$w_item.id}" method="POST">
<input type="hidden" name="w_log_id" value="{$w_item.id}">
<input type="hidden" name="prev_w_id" value="{$w_item.prev_w_id}">
<table class="output_release_tbl">
	<tr>
		<td style="width:20%; background:#e6e6e6">
			품목코드
		</td>
		<td>
			<input type="text" name="w_id" readonly class="smart_input_release" value="{$w_item.w_id}">
		</td>
	</tr>
	<tr>
		<td style="width:20%; background:#e6e6e6">
			품목명
		</td>
		<td>
			<input type="text" name="product_name" readonly class="smart_input_release" value="{$w_item.product_name}">
		</td>
	</tr>
	<tr>
		<td style="width:20%; background:#e6e6e6;">
			현재 수량
		</td>
		<td>
			<input type="number" name="prev_cnt" class="smart_input_release" readonly value="{$w_item.current_cnt}">
		</td>
	</tr>
	<tr>
		<td style="width:20%; background:#e6e6e6; ">
			출고 수량
		</td>
		<td>
			<input type="number" name="release_cnt" class="smart_input_release" min="0" max="{$w_item.current_cnt}">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="출고" style="width:70%;">
		</td>
	</tr>
</table>
</form>
{/foreach}

{include file="footer.tpl"}
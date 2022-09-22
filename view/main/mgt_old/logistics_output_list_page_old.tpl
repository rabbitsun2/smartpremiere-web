{include file="header.tpl"}

<script type="text/javascript">

	var openWin;

	function openDetailView(id){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("product?func=list&id=" + id + "&option=detail_view" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
	}

	
	function goCart(w_id){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("logistics?func=cart&w_id=" + w_id + "&option=add" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
	}

</script>
				<h3 class="sub_title">물류/출고</h3>
				<hr class="sub_hr">
<!-- 검색 영역 -->
<form action="logistics?func=output" method="GET">
<input type="hidden" name="func" value="output">
<table class="output_search_tbl">
	<tr>
		<td style="width:10%">
			품목명
		</td>
		<td style="width:50%">
			<input type="text" name="keyword" class="smart_input_search">
		</td>
		<td style="width:40%">
			<input type="submit" class="ui-button ui-widget ui-corner-all btn_submit" type="submit"
				value="검색">
			<a href="logistics?func=output&status=cart" class="ui-button ui-widget ui-corner-all btn_submit">장바구니</a>
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
				기능
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
				{$w_item.project_id}/{$w_item.w_id}
			</td>
			<td>
				{$w_item.project_name}/{$w_item.product_name}
			</td>
			<td>
				<a href="#" onclick="openDetailView({$w_item.product_id})">상세</a>
			</td>
			<td>
				{$w_item.create_date}
			</td>
			<td>
				{$w_item.current_cnt}
			</td>
			<td>
				<a href="logistics?func=output&status=release&id={$w_item.id}">출고</a><br>
				<a href="logistics?func=barcode&option=print&id={$w_item.w_id}&barcodeKey={$barcode_token}" target="_blank">제품별 바코드</a><br>
				<a href="#" onclick="goCart({$w_item.w_id})">제품 담기</a>
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
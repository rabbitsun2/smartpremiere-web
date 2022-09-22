{include file="header.tpl"}


	<script type="text/javascript">
	  	var openWin;

		function detailView(id){

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

		function goModify(id){
			location.replace('product?func=modify&id=' + id);
		}

		function goDelete(id){

			if ( confirm ( id + '번 제품을 삭제하시겠습니까?') == true ){
				location.replace('product?func=delete&id=' + id );
			}
			else{
				return;
			}

		}

	</script>
				<h3 class="sub_title">프로젝트(제품) / 제품 현황</h3>
				<hr class="sub_hr">

<table class="item_status_tbl">
	<thead>
		<tr>
			<th style="width:10%">
				제품번호
			</th>
			<th style="width:25%">
				제품명
			</th>
			<th style="width:25%">
				설명
			</th>
			<th>
				기능
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
				{$u_item.product_id}
			</td>
			<td>
				{$u_item.product_name}
			</td>
			<td>
				{$u_item.description}
			</td>
			<td>
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="상세" onclick="detailView({$u_item.product_id})">
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="수정" onclick="goModify({$u_item.product_id})">
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="삭제" onclick="goDelete({$u_item.product_id})">
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
{include file="header.tpl"}

	<script type="text/javascript">
	  var openWin;
		function openChild(){

			var popupWidth = 900;
			var popupHeight = 650;

			var popupX = (window.screen.width / 2) - (popupWidth / 2);
			// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

			var popupY= (window.screen.height / 2) - (popupHeight / 2);
			// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

	    	// window.name = "부모창 이름";
			window.name = "parentForm";
			// window.open("open할 window", "자식창 이름", "팝업창 옵션");
			openWin = window.open("logistics?func=input&search=product",
		        "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
				"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
		}
	</script>

				<h3 class="sub_title">물류/입고</h3>
				<hr class="sub_hr">
				<br>
				<form action="logistics?func=input" method="POST">
				<input type="hidden" name="func" value="input">
				<input type="hidden" name="srtype" value="submit">
				<div class="input_center">
				<table class="input_page_tbl">
					<tr>
						<td style="width:15%; text-align:center; background:#e2e2e2;">
							품목명
						</td>
						<td style="width:70%;">
							<input type="text" id="pInput_productName" name="productName" style="width:90%;" readonly>
						</td>
						<td>
							<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="찾기" onclick="openChild()">
						</td>
					</tr>
					<tr>
						<td style="text-align:center;background:#e2e2e2;">
							품목코드
						</td>
						<td colspan="2">
							<input type="text" id="pInput_productCode" name="productCode" style="width:90%;" readonly>
						</td>
					</tr>
					<tr>
						<td style="text-align:center; background:#e2e2e2;">
							수량
						</td>
						<td colspan="2">
							<input type="number" name="productNum" style="width:90%;" min="0" max="100">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="입고" style="width:50%;">
						</td>
					</tr>
				</table>
				</div>
				</form>
{include file="footer.tpl"}

{include file="html5_header.tpl"}
{include file="menu_logistics.tpl"}        
{include file="html5_layout.tpl"}

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

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
				<form action="logistics?func=input" method="POST">
				<input type="hidden" name="func" value="input">
				<input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">제품 입고</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">품목명</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="pInput_productName" name="productName" style="width:90%;" readonly id="html5-search-input" />
                                <input class="btn btn-primary" type="button" value="찾기" onclick="openChild()">
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">품목코드</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="pInput_productCode" name="productCode" style="width:90%;" readonly id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">수량</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="productNum" style="width:90%;" min="0" max="10000" id="html5-search-input" />
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">등록</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
{include file="html5_header.tpl"}
{include file="menu_logistics.tpl"}        
{include file="html5_layout.tpl"}

    
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

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">창고/출고</h5>

                    <!-- 검색 영역 -->
                    <form action="logistics?func=output" method="GET">
                    <input type="hidden" name="func" value="output">

                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">검색</label>
                        <div class="col-md-7">
                          <!--<input class="form-control" type="search" list="datalistOptions" value="검색 ..." id="html5-search-input" />-->
                          <input class="form-control" name="keyword" type="search" value="검색 ..." id="html5-search-input" />
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">검색</button>
                            <a href="logistics?func=output&status=cart" class="btn btn-primary">장바구니</a>
                        </div>
                      </div>
                    </form>
                    
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                    
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
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
                                <tbody class="table-border-bottom-0">
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
                                            <a class="dropdown-item" href="logistics?func=output&status=release&id={$w_item.id}">
                                                <span class="bx bx-edit-alt me-2"></span> 출고</a>
                                            <a class="dropdown-item" href="logistics?func=barcode&option=print&id={$w_item.w_id}&barcodeKey={$barcode_token}">
                                                <span class="bx bx-edit-alt me-2"></span> 제품별 바코드</a>
                                            <a class="dropdown-item" href="javascript:goCart({$w_item.w_id});">
                                                <span class="bx bx-edit-alt me-2"></span> 제품 담기</a>
                                            <!--
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                <a class="dropdown-item" href="logistics?func=output&status=release&id={$w_item.id}">
                                                    <i class="bx bx-edit-alt me-2"></i> 출고</a>
                                                <a class="dropdown-item" href="logistics?func=barcode&option=print&id={$w_item.w_id}&barcodeKey={$barcode_token}">
                                                    <i class="bx bx-edit-alt me-2"></i> 제품별 바코드</a>
                                                <a class="dropdown-item" href="javascript:goCart({$w_item.w_id});">
                                                    <i class="bx bx-edit-alt me-2"></i> 제품 담기</a>
                                                </div>
                                            </div>
                                            -->
                                        </td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>

                
                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    {include file="paging.tpl"}
                    </div>
                </div>
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
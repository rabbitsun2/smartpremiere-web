{include file="html5_header.tpl"}
{include file="menu_logistics.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">

	var openWin;
	
	function goCartRemove(w_id){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("logistics?func=cart&w_id=" + w_id + "&option=remove" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");

		
	}

	
	function goCartAllRemove(){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("logistics?func=cart&w_id=all&option=remove&barcodeKey={$barcode_token}" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");

		
	}

</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">창고/출고 - 바코드(QR) 장바구니</h5>

                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">기능</label>
                        <div class="col-md-7">
                            <a href="logistics?func=barcode&option=print&barcodeKey={$barcode_token}" class="btn btn-primary">바코드 출력</a>
                            <a href="#" onclick="goCartAllRemove()" class="btn btn-primary">내용 비우기</a>
                            <a href="logistics?func=output" class="btn btn-primary">전체보기</a>
                        </div>
                      </div>
                    </form>
                                        
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
                                            프로젝트/제품번호
                                        </th>
                                        <th style="width:35%">
                                            프로젝트명/품목명
                                        </th>
                                        <th>
                                            수량
                                        </th>
                                        <th style="width:15%">
                                            현재유형
                                        </th>
                                        <th style="width:10%">
                                            등록일자
                                        </th>
                                        <th style="width:10%">
                                            비고
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    {section name=m_val loop=$result_rows}
                                    <tr>
                                        <td>
                                            {$result_rows[m_val].id}
                                        </td>
                                        <td>
                                            {$result_rows[m_val].project_id} / {$result_rows[m_val].product_id}
                                        </td>
                                        <td>
                                            {$result_rows[m_val].project_name} / {$result_rows[m_val].product_name}
                                        </td>
                                        <td>
                                            {$result_rows[m_val].current_cnt}
                                        </td>
                                        <td>
                                            {$result_rows[m_val].current_type}
                                        </td>
                                        <td>
                                            {$result_rows[m_val].regidate}
                                        </td>
                                        <td>
                                            <a href="#" onclick="goCartRemove({$result_rows[m_val].id})">삭제</a>
                                        </td>
                                    </tr>
                                    {/section}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
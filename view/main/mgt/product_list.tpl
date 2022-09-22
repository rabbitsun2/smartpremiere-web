{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

    <script type="text/javascript">

        /*
	  	var openWin;

		function goDetailView(id){

			var popupWidth = 870;
			var popupHeight = 550;

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
        */

        function goDetailView(id){
            $('#my_frame').attr('src', 'product?func=list&id=' + id + '&option=detail_view');
            $('#modalCenter').modal('show');
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

		function goBox(id){
			location.replace('product?func=modify&id=' + id + '&option=box');
		}

	</script>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">프로젝트/제품 현황</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
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
                    <tbody class="table-border-bottom-0">
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
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:goDetailView({$u_item.product_id});">
                                        <i class="bx bx-edit-alt me-2"></i> 상세</a>
                                    <a class="dropdown-item" href="javascript:goModify({$u_item.product_id});">
                                        <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                    <a class="dropdown-item" href="javascript:goDelete({$u_item.product_id});">
                                        <i class="bx bx-trash me-2"></i> 삭제</a>
                                    <a class="dropdown-item" href="javascript:goBox({$u_item.product_id});">
                                        <i class="bx bx-trash me-2"></i> 상자</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {$u_item.regidate}
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                  </table>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">제품 상세</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="닫기"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id='my_frame' style="width:100%;height:400px"></iframe>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        닫기
                    </button>
                    </div>
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
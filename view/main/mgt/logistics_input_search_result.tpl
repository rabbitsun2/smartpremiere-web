{include file="html5_header.tpl"}  
          
    <script type="text/javascript">
        
        var openWin;

		function openChild(id){

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

        function setParentText(num){
            opener.document.getElementById("pInput_productCode").value = document.getElementById("cProduct_id_" + num).value
            opener.document.getElementById("pInput_productName").value = document.getElementById("cProduct_name_" + num).value
        }

	</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">제품/검색 결과</h5>
                <a href="javascript:history.back()">이전으로</a>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%" class="head">
                                품목코드
                            </th>
                            <th style="width:20%" class="head">
                                품목명
                            </th>
                            <th style="width:25%" class="head">
                                설명
                            </th>
                            <th class="head">
                                기능
                            </th>
                            <th style="width:15%" class="head">
                                등록일자
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    {foreach $productList as $productitem}
                        <tr>
                            <td>
                                <input type="hidden" id="cProduct_id_{$productitem.product_id}" value="{$productitem.product_id}">
                                {$productitem.product_id}
                            </td>
                            <td>
                                <input type="hidden" id="cProduct_name_{$productitem.product_id}" value="{$productitem.product_name}">
                                <a href="#" onclick="setParentText({$productitem.product_id})">{$productitem.product_name}</a>
                            </td>
                            <td>
                                {$productitem.description}
                            </td>
                            <td>
                                <a href="#" onclick="openChild({$productitem.product_id})">상세보기</a>
                            </td>
                            <td>
                                {$productitem.regidate}
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                  </table>
                                        
                </div>
              </div>

                <div style="text-align:center;">
                <!-- 페이징 영역 -->
                {include file="paging.tpl"}
                </div>

            <input class="btn btn-primary" type="button" value="창닫기" onclick="window.close()">

            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
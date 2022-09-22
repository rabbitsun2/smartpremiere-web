{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    var openWin;
    function openChild(){

        var popupWidth = 950;
        var popupHeight = 500;

        var popupX = (window.screen.width / 2) - (popupWidth / 2);
        // 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

        var popupY= (window.screen.height / 2) - (popupHeight / 2);
        // 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

        // window.name = "부모창 이름";
        window.name = "parentForm";
        // window.open("open할 window", "자식창 이름", "팝업창 옵션");
        openWin = window.open("product?func=input&search=project",
            "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
            "left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <form action="product?func=modify" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">제품 수정</h5>
                    <div class="card-body">        
                        {section name=usr_item1 loop=$product_item}
                        <input type="hidden" name="cur_project_id" value="{$product_item[usr_item1].project_id}">
                        <input type="hidden" name="cur_product_id" value="{$product_item[usr_item1].product_id}">
                        <input type="hidden" name="func" value="modify">
                        <input type="hidden" name="srtype" value="submit">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">프로젝트 번호</label>
                            <div class="col-md-10">
                                <input class="form-control" id="pInput_project_id" name="project_id" readonly value="{$product_item[usr_item1].project_id}" type="text" id="html5-text-input" />
                                
                                <input class="btn btn-primary" type="button" 
                                    value="찾기" onclick="openChild()">
                            </div>
                        </div>
                            <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">프로젝트 명</label>
                            <div class="col-md-10">
                                <input class="form-control" id="pInput_project_name" name="project_name" readonly value="{$product_item[usr_item1].project_name}" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">제품명</label>
                            <div class="col-md-10">
                                <input class="form-control" id="pInput_project_name" name="product_name" value="{$product_item[usr_item1].product_name}" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">설명</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="description" rows="5" cols="35">{$product_item[usr_item1].description}</textarea>
                                </div>
                            </div>                            
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">파일1</label>
                                <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">수정</button>
                                </div>
                            </div>
                            {/section}
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
            
            <div class="card mb-4">
                <h5 class="card-header">파일 목록</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                {section name=usr_item2 loop=$project_file_item}
                                <tr>
                                    <td style="width:10%; background:#e2e2e2;">파일</td>
                                    <td>
                                        <a href="project?func=download&uuid={$project_file_item[usr_item2].uuid}">{$project_file_item[usr_item2].original_name}</a> / ({$project_file_item[usr_item2].file_size})
                                    </td>
                                    <td style="width:10%;">
                                        <a href="project?func=download&uuid={$project_file_item[usr_item2].uuid}&project_id={$project_file_item[usr_item2].project_id}&page=delete">삭제</a>
                                    </td>
                                </tr>
                                {/section}
                            </tbody>
                        </table>
                    <div>
                </div>
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
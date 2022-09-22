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

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="product?func=register" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">제품 등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">프로젝트 번호</label>
                            <div class="col-md-10">
                                <input class="form-control" readonly id="pInput_project_id" name="project_id" type="text" id="html5-text-input" />
                                <input class="btn btn-primary" type="button" value="찾기" onclick="openChild()">
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">프로젝트 명</label>
                                <div class="col-md-10">
                                    <input class="form-control" readonly id="pInput_project_name" name="project_name" type="text" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">제품명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="product_name" type="text" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">설명</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="description" rows="5" cols="35"></textarea>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">파일1</label>
                                <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">파일2</label>
                                <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
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
{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="project?func=register" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">프로젝트명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="project_name" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">설명</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="description" rows="5" cols="35"></textarea>
                            </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-email-input" class="col-md-2 col-form-label">시작일자</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" name="startdate" id="html5-email-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-email-input" class="col-md-2 col-form-label">종료일자</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="datetime-local" name="enddate" id="html5-email-input" />
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
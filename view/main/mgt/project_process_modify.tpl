{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="project?func=process&project_id={$project_id}&view=modify&uuid=no" method="POST" enctype="multipart/form-data" />
                <input type="hidden" name="process_uuid" value="{$process_uuid}" />
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="modify" />
                <input type="hidden" name="srtype" value="submit" />
                {section name=usr_item1 loop=$project_process_item}
                <input type="hidden" name="order_val" value="{$project_process_item[usr_item1].order_val}" />

                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트/공정 수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">공정명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="project_name" type="text" id="html5-text-input" value="{$project_process_item[usr_item1].process_name}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">수정</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                
                {/section}

            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
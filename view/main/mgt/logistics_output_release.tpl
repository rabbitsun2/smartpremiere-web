{include file="html5_header.tpl"}
{include file="menu_logistics.tpl"}        
{include file="html5_layout.tpl"}
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                {foreach $warehouse_rows as $w_item}
                <form action="logistics?func=output&status=w_ok&id={$w_item.id}" method="POST">
                <input type="hidden" name="w_log_id" value="{$w_item.id}">
                <input type="hidden" name="prev_w_id" value="{$w_item.prev_w_id}">`
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">창고/출고 작업</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">품목코드</label>
                            <div class="col-md-10">
                                <input class="form-control" name="w_id" readonly name="project_id" value="{$w_item.w_id}" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">품목명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="product_name" readonly type="text" value="{$w_item.product_name}" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">현재 수량</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="prev_cnt" type="number" id="html5-search-input" readonly value="{$w_item.current_cnt}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">출고 수량</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="release_cnt" type="number" id="html5-search-input" min="0" max="{$w_item.current_cnt}" />
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
            
            {/foreach}

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
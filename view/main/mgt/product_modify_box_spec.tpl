{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            {section name=usr_item1 loop=$box_item}
            <form action="product?func=modify&id={$box_item[usr_item1].product_id}&option=box" method="POST" enctype="multipart/form-data">
            {/section}
            <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">상자 수정</h5>
                    <div class="card-body">        
                        {section name=usr_item1 loop=$box_item}
                        <input type="hidden" name="product_id" value="{$box_item[usr_item1].product_id}">
                        <input type="hidden" name="func" value="modify">
                        <input type="hidden" name="srtype" value="submit">
                        {/section}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">상자 유형</label>
                            <div class="col-md-10">
                                <select name="box_type_id" class="form-select">
                                    {section name=usr_item1 loop=$box_item}
                                    <option value="{$box_item[usr_item1].box_type_id}">{$box_item[usr_item1].type_name}</option>
                                    {/section}
                                    {section name=usr_item1 loop=$box_type_item}
                                    <option value="{$box_type_item[usr_item1].box_type_id}">{$box_type_item[usr_item1].type_name}</option>
                                    {/section}
                                </select>
                            </div>
                        </div>
                        {section name=usr_item1 loop=$box_item}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">가로</label>
                            <div class="col-md-10">
                                <input class="form-control" name="width" value="{$box_item[usr_item1].width}" type="number" min="0" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">세로</label>
                            <div class="col-md-10">
                                <input class="form-control" name="length" type="number" min="0" value="{$box_item[usr_item1].length}" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">높이</label>
                            <div class="col-md-10">
                                <input class="form-control" name="height" type="number" min="0" value="{$box_item[usr_item1].height}" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">상자 이름</label>
                            <div class="col-md-10">
                                <input class="form-control" name="box_name" value="{$box_item[usr_item1].box_name}" type="text" id="html5-text-input" />
                            </div>
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
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
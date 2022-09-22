{include file="html5_header.tpl"}
{include file="menu_account_auth.tpl"}        
{include file="html5_layout.tpl"}
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="member_auth?func=register" method="POST">
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">권한/등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">권한명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="auth_name" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">권한 목록</label>
                                <div class="col-md-10"> 
                                <select class="form-select">
                                {section name=item_val loop=$member_auth_list}
                                    <option value="{$member_auth_list[item_val].id}">{$member_auth_list[item_val].auth_name}</option>
                                {/section}
                                </select>
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

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
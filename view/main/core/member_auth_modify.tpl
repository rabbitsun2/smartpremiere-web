{include file="html5_header.tpl"}
{include file="menu_account_auth.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goHistoryBack(){
        location.replace('member_auth?func=list' );
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="member_auth?func=modify" method="POST">
                {section name=item_val1 loop=$member_auth_item}
                <input type="hidden" name="id" value="{$member_auth_item[item_val1].id}">
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">권한/수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">권한명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="auth_name" type="text" id="html5-text-input" value="{$member_auth_item[item_val1].auth_name}" />
                            </div>
                            </div>
                            {/section}
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">권한 목록</label>
                                <div class="col-md-10">
                                    <select class="form-select">
                                    {section name=item_val2 loop=$member_auth_list}
                                        <option value="{$member_auth_list[item_val2].id}">{$member_auth_list[item_val2].auth_name}</option>
                                    {/section}
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <button type="submit" style="width:220px" class="btn btn-primary">수정</button>
                                </div>
                                <div class="col-md-5">
                                    <input readonly class="btn btn-primary"
                                        onclick="goHistoryBack()" value="이전">
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
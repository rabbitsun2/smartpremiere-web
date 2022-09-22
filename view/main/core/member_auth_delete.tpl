{include file="html5_header.tpl"}
{include file="menu_account_auth.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goHistoryBack(){
        location.replace('member?func=list' );
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="member_auth?func=delete" method="POST">
                {section name=item_val1 loop=$member_auth_item}
                <input type="hidden" name="id" value="{$member_auth_item[item_val1].id}">
                <input type="hidden" name="func" value="delete">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">권한/삭제</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">권한명</label>
                            <div class="col-md-10">
                                {$member_auth_item[item_val1].auth_name}
                            </div>
                        </div>
                        {/section}
                        <div class="mb-3 row">
                            <div class="col-md-10">
                                정말로 삭제하시겠습니까?
                            </div>
                        </div>
                            
                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <button type="submit" style="width:220px" class="btn btn-primary">삭제</button>
                            </div>
                            <div class="col-md-5">
                                <input readonly class="btn btn-primary"
                                    onclick="goHistoryBack()" value="이전">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
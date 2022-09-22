{include file="html5_header.tpl"}
{include file="menu_account.tpl"}        
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
            
                {section name=usr_auth_item loop=$member_item}
                <form action="member?func=delete" method="POST">
                <input type="hidden" name="idx" value="{$member_item[usr_auth_item].member_id}">
                <input type="hidden" name="email" value="{$member_item[usr_auth_item].email}">
                <input type="hidden" name="func" value="delete">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">계정/사용자 삭제</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10">
                                {$member_item[usr_auth_item].email}
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">권한</label>
                                <div class="col-md-10">                        
                                    {$member_item[usr_auth_item].auth_name}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">성명</label>
                                <div class="col-md-10">
                                    {$member_item[usr_auth_item].usrname}
                                </div>
                            </div>
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
            </div>

            {/section}
            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
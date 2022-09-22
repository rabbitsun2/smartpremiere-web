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
                <form action="member?func=modify" method="POST">
                {section name=usr_auth_item loop=$member_item}
                <input type="hidden" name="idx" value="{$member_item[usr_auth_item].member_id}">
                <input type="hidden" name="email" value="{$member_item[usr_auth_item].email}">
                {/section}
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">계정/사용자 수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">권한</label>
                            <div class="col-md-10">
                                <select class="form-select" name="member_auth" style="width:90%;">
                                {section name=usr_auth_item loop=$member_item}
                                    <option value="{$member_item[usr_auth_item].member_auth}">{$member_item[usr_auth_item].auth_name}</option>
                                {/section}
                                {section name=member_auth loop=$member_auth_list}
                                    <option value="{$member_auth_list[member_auth].id}">{$member_auth_list[member_auth].auth_name}</option>
                                {/section}
                                </select>
                            </div>
                            </div>
                            
                            {section name=usr_auth_item loop=$member_item}
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">이메일</label>
                                <div class="col-md-10">
                                    {$member_item[usr_auth_item].email}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">성명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="usrname" type="text" id="html5-text-input" value="{$member_item[usr_auth_item].usrname}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">신규 비밀번호</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd1" type="password" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">신규 비밀번호 확인</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd2" type="password" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">상태</label>
                                <div class="col-md-10">
                                    <select name="locked" class="form-select">
                                    {section name=usr_locked_item loop=$member_item}
                                        <option value="{$member_item[usr_locked_item].locked}">{$member_item[usr_locked_item].locked}</option>
                                    {/section}
                                        <option value="활성">활성</option>
                                        <option value="비활성">비활성</option>
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

            {/section}
            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
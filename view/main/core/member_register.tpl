{include file="html5_header.tpl"}
{include file="menu_account.tpl"}        
{include file="html5_layout.tpl"}
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="member?func=register" method="POST">
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">계정/사용자 등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10">
                                <input class="form-control" name="email" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">권한</label>
                                <div class="col-md-10">                        
                                    <select class="form-select" name="member_auth">
                                    {foreach $member_auth_list as $member_item}
                                        <option value="{$member_item.id}">{$member_item.auth_name}</option>
                                    {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">성명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="usrname" type="text" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">비밀번호</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd1" type="password" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">비밀번호 확인</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd2" type="password" id="html5-search-input" />
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
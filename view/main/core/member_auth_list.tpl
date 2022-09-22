{include file="html5_header.tpl"}
{include file="menu_account_auth.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">권한/관리</h5>
                    <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:7%">
                                    번호
                                </th>
                                <th>
                                    권한명
                                </th>
                                <th style="width:15%">
                                    비고
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            {section name=item_val loop=$memberAuthList}
                            <tr>
                                <td>
                                    {$memberAuthList[item_val].id}
                                </td>
                                <td>
                                    {$memberAuthList[item_val].auth_name}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="member_auth?func=modify&id={$memberAuthList[item_val].id}">
                                            <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                        <a class="dropdown-item" href="member_auth?func=delete&id={$memberAuthList[item_val].id}">
                                            <i class="bx bx-trash me-2"></i> 삭제</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {/section}
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
              </div>

                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    {include file="paging.tpl"}
                    </div>
                </div>
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
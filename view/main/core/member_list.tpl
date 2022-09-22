{include file="html5_header.tpl"}
{include file="menu_account.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">계정/사용자 관리</h5>
                    <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:7%">
                                    번호
                                </th>
                                <th style="width:10%">
                                    이메일
                                </th>
                                <th style="width:10%">
                                    권한명
                                </th>
                                <th>
                                    사용자명
                                </th>
                                <th style="width:20%">
                                    등록일자
                                </th>
                                <th style="width:20%">
                                    수정일자
                                </th>
                                <th style="width:20%">
                                    비고
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            {foreach $memberList as $item}
                            <tr>
                                <td>
                                    {$item.member_id}
                                </td>
                                <td>
                                    {$item.email}
                                </td>
                                <td>
                                    {$item.auth_name}
                                </td>
                                <td>
                                    {$item.usrname}
                                </td>
                                <td>
                                    {$item.regidate}
                                </td>
                                <td>
                                    {$item.modify_date}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="member?func=modify&id={$item.member_id}">
                                            <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                        <a class="dropdown-item" href="member?func=delete&id={$item.member_id}">
                                            <i class="bx bx-trash me-2"></i> 삭제</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
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
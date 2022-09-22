{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    function goDetail(id){
        $('#my_frame').attr('src', 'project?func=list&id=' + id + '&option=detail_view');
        $('#modalCenter').modal('show');
    }

    function goModify(id){
        location.replace('project?func=modify&id=' + id );
    }

    function goDelete(id){
        if ( confirm ( id + '번 프로젝트를 삭제하시겠습니까?') == true ){
            location.replace('project?func=delete&id=' + id );
        }
        else{
            return;
        }
    }

    function goProcess(id){
        location.replace('project?func=process&project_id=' + id + '&view=list');
    }

</script>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">프로젝트 현황</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%;background-color:#F3F781;">
                                프로젝트번호
                            </th>
                            <th colspan="3" style="width:60%;background-color:#F3F781;">
                                프로젝트명
                            </th>
                            <th style="background-color:#F3F781;">
                                비고
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    {section name=pjt_list_item loop=$projectList}
                      <tr>
                            <td style="background-color:#E1F5A9;">
                                {$projectList[pjt_list_item].project_id}
                            </td>
                            <td colspan="3" style="background-color:#E1F5A9;">
                                {$projectList[pjt_list_item].project_name}
                            </td>
                            <td style="background-color:#E1F5A9;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:goDetail('{$projectList[pjt_list_item].project_id}');">
                                        <i class="bx bx-edit-alt me-2"></i> 상세</a>
                                    <a class="dropdown-item" href="javascript:goModify('{$projectList[pjt_list_item].project_id}');">
                                        <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                    <a class="dropdown-item" href="javascript:goDelete('{$projectList[pjt_list_item].project_id}');">
                                        <i class="bx bx-trash me-2"></i> 삭제</a>
                                    <a class="dropdown-item" href="javascript:goProcess('{$projectList[pjt_list_item].project_id}');">
                                        <i class="bx bx-edit-alt me-2"></i> 공정</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="background-color:#F5DA81;">
                                <span style="font-weight:bold">설명</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                {$projectList[pjt_list_item].description}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                
                                <!-- 프로젝트 상세 내용-->
                                <table class="project_item_detail_tbl">
                                    <thead>
                                        <tr>
                                            <th style="width:35%">
                                                시작일자
                                            </td>
                                            <th style="width:35%">
                                                종료일자
                                            </td>
                                            <th style="width:35%">
                                                등록일자
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {$projectList[pjt_list_item].startdate}
                                            </td>
                                            <td>
                                                {$projectList[pjt_list_item].enddate}
                                            </td>
                                            <td>
                                                {$projectList[pjt_list_item].regidate}
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                
                            </td>
                        </tr>
                    {/section}
                    </tbody>
                  </table>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">프로젝트 상세</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="닫기"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id='my_frame' style="width:100%;height:400px"></iframe>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        닫기
                    </button>
                    </div>
                </div>
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
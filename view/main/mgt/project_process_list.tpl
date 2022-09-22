{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goModify(project_id, uuid){
        location.replace('project?func=process&project_id=' + project_id + '&uuid=' + uuid + '&view=modify' );
    }

    function goDelete(project_id, process_name, uuid){
        location.replace('project?func=process&project_id=' + project_id + '&uuid=' + uuid + '&view=delete' );
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
                <h5 class="card-header">프로젝트/공정 관리</h5>
                    <div class="row justify-content-end">
                        <div class="col-sm-1">
                            <a class="btn btn-primary" href="project?func=process&project_id={$project_id}&view=register">등록</a>
                        </div>
                        <div class="col-sm-9">
                        </div>
                    </div>
                    <br>
                </div>
                <br>
                <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:5%">
                                번호
                            </th>
                            <th style="width:10%">
                                프로젝트 번호
                            </th>
                            <th style="width:25%">
                                공정명
                            </th>
                            <th style="width:10%">
                                순서
                            </th>
                            <th>
                                등록일자
                            </th>
                            <th style="width:10%">
                                비고
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {assign var='num' value=0}
                        {foreach $projectProcessList as $u_item}
                        {assign var='num' value=$num+1}
                        <tr>
                            <td>
                                {$num}
                            </td>
                            <td>
                                {$u_item.project_id}
                            </td>
                            <td>
                                {$u_item.process_name}
                            </td>
                            <td>
                                {$u_item.order_val}
                            </td>
                            <td>
                                {$u_item.regidate}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:goModify('{$u_item.project_id}', '{$u_item.process_uuid}');">
                                        <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                    <a class="dropdown-item" href="javascript:goDelete('{$u_item.project_id}', '{$u_item.process_name}', '{$u_item.process_uuid}');">
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
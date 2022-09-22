{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goHistoryBack(id){
        location.replace('project?func=modify&id=' + id );
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="project?func=modify" method="POST" enctype="multipart/form-data">
                {section name=usr_item1 loop=$project_file_item}
                <input type="hidden" name="project_id" value="{$project_file_item[usr_item1].project_id}">
                <input type="hidden" name="uuid" value="{$project_file_item[usr_item1].uuid}">
                <input type="hidden" name="func" value="file_delete">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 파일 삭제</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="background-color:#F3F781;">
                                                프로젝트번호 / 프로젝트명
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>
                                                {$project_file_item[usr_item1].original_name}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>정말로 삭제하시겠습니까?</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="btn btn-primary" type="submit" 
                                                        value="삭제" style="width:45%;">
                                                <input readonly class="btn btn-primary"
                                                    onclick="goHistoryBack('{$project_file_item[usr_item1].project_id}')"
                                                    style="width:40%;" value="이전">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/section}
            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
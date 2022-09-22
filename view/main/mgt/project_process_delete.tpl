{include file="html5_header.tpl"}
{include file="menu_project_and_product.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goHistoryBack(project_id){
        location.replace('project?func=process&project_id=' + project_id + '&view=list' );
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

                <form action="project?func=process&project_id={$project_id}&view=delete&uuid=no" method="POST" enctype="multipart/form-data" />
                
                {section name=usr_item1 loop=$project_process_item}
                <input type="hidden" name="process_uuid" value="{$project_process_item[usr_item1].process_uuid}" />
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="delete" />
                <input type="hidden" name="srtype" value="submit" />
                <input type="hidden" name="order_val" value="{$project_process_item[usr_item1].order_val}" />
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트/공정 삭제</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>
                                                {$project_process_item[usr_item1].process_name}
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
                                                    onclick="goHistoryBack('{$project_process_item[usr_item1].project_id}')"
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
<?php
/* Smarty version 4.1.1, created on 2022-09-07 21:22:38
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\project_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63188d0ee882e5_75447308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bae89b5dcd7c6e0527d9f08743c77c744ec306da' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\project_list.tpl',
      1 => 1662242480,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_project_and_product.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63188d0ee882e5_75447308 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '42089336563188d0ee15373_99572043';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_project_and_product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript">
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

<?php echo '</script'; ?>
>

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
                    <?php
$__section_pjt_list_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['projectList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pjt_list_item_0_total = $__section_pjt_list_item_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item'] = new Smarty_Variable(array());
if ($__section_pjt_list_item_0_total !== 0) {
for ($__section_pjt_list_item_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] = 0; $__section_pjt_list_item_0_iteration <= $__section_pjt_list_item_0_total; $__section_pjt_list_item_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']++){
?>
                      <tr>
                            <td style="background-color:#E1F5A9;">
                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_id'];?>

                            </td>
                            <td colspan="3" style="background-color:#E1F5A9;">
                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_name'];?>

                            </td>
                            <td style="background-color:#E1F5A9;">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:goDetail('<?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_id'];?>
');">
                                        <i class="bx bx-edit-alt me-2"></i> 상세</a>
                                    <a class="dropdown-item" href="javascript:goModify('<?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_id'];?>
');">
                                        <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                    <a class="dropdown-item" href="javascript:goDelete('<?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_id'];?>
');">
                                        <i class="bx bx-trash me-2"></i> 삭제</a>
                                    <a class="dropdown-item" href="javascript:goProcess('<?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['project_id'];?>
');">
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
                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['description'];?>

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
                                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['startdate'];?>

                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['enddate'];?>

                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['projectList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pjt_list_item']->value['index'] : null)]['regidate'];?>

                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                
                            </td>
                        </tr>
                    <?php
}
}
?>
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
                    <?php $_smarty_tpl->_subTemplateRender("file:paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

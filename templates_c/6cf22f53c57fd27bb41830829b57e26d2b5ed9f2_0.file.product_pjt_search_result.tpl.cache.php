<?php
/* Smarty version 4.1.1, created on 2022-09-07 20:09:43
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\product_pjt_search_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63187bf798f121_39984448',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cf22f53c57fd27bb41830829b57e26d2b5ed9f2' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\product_pjt_search_result.tpl',
      1 => 1662530860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63187bf798f121_39984448 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '73733624763187bf7977134_62160028';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>  
          <?php echo '<script'; ?>
 type="text/javascript">
              function setParentText(num){
                  //alert( '참' );
                  //alert( document.getElementById("cProject_name_" + num).value );
                  opener.document.getElementById("pInput_project_id").value = document.getElementById("cProject_id_" + num).value;
                  opener.document.getElementById("pInput_project_name").value = document.getElementById("cProject_name_" + num).value;
                  
              }
          <?php echo '</script'; ?>
>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">프로젝트/검색 결과</h5>
                <a href="javascript:history.back()">이전으로</a>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:15%">
                                프로젝트 번호
                            </th>
                            <th>
                                프로젝트명
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projectList']->value, 'projectitem');
$_smarty_tpl->tpl_vars['projectitem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['projectitem']->value) {
$_smarty_tpl->tpl_vars['projectitem']->do_else = false;
?>
                      <tr>
                          <td>
                              <input type="hidden" id="cProject_id_<?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_id'];?>
">
                              <?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_id'];?>

                          </td>
                          <td>
                              <input type="hidden" id="cProject_name_<?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_name'];?>
">
                              <a href="#" onclick="setParentText(<?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['projectitem']->value['project_name'];?>
</a>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <table>
                                  <tr>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          시작일자
                                      </td>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          종료일자
                                      </td>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          등록일자
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <?php echo $_smarty_tpl->tpl_vars['projectitem']->value['startdate'];?>

                                      </td>
                                      <td>
                                          <?php echo $_smarty_tpl->tpl_vars['projectitem']->value['enddate'];?>

                                      </td>
                                      <td>
                                          <?php echo $_smarty_tpl->tpl_vars['projectitem']->value['regidate'];?>

                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                  </table>
                                        
                </div>
                    <input class="btn btn-primary" type="button" value="창닫기" onclick="window.close()">
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

<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:29:24
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\member_auth_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631848542670e3_53574701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10456cb1ae9b1b74bee2b812c6f10e964fcacab1' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\member_auth_list.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_account_auth.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631848542670e3_53574701 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '628264872631848541ee515_09249321';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_account_auth.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                            <?php
$__section_item_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['memberAuthList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_val_0_total = $__section_item_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_item_val'] = new Smarty_Variable(array());
if ($__section_item_val_0_total !== 0) {
for ($__section_item_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] = 0; $__section_item_val_0_iteration <= $__section_item_val_0_total; $__section_item_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']++){
?>
                            <tr>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['memberAuthList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['id'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['memberAuthList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['auth_name'];?>

                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="member_auth?func=modify&id=<?php echo $_smarty_tpl->tpl_vars['memberAuthList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['id'];?>
">
                                            <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                        <a class="dropdown-item" href="member_auth?func=delete&id=<?php echo $_smarty_tpl->tpl_vars['memberAuthList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['id'];?>
">
                                            <i class="bx bx-trash me-2"></i> 삭제</a>
                                        </div>
                                    </div>
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

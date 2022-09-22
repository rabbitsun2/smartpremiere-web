<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:23:46
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\member_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63184702c15366_19417477',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fc0efaba9702057eeb2ecde05f9954dce03ed42' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\member_list.tpl',
      1 => 1662535400,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_account.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63184702c15366_19417477 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '45923846063184702c08d24_36713671';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['memberList']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                            <tr>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['member_id'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['email'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['auth_name'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['usrname'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['regidate'];?>

                                </td>
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['modify_date'];?>

                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="member?func=modify&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['member_id'];?>
">
                                            <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                        <a class="dropdown-item" href="member?func=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['member_id'];?>
">
                                            <i class="bx bx-trash me-2"></i> 삭제</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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

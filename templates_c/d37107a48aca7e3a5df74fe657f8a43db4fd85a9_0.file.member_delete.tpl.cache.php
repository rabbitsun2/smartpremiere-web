<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:11:56
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\member_delete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6318443ceb4966_16037920',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd37107a48aca7e3a5df74fe657f8a43db4fd85a9' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\member_delete.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_account.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_6318443ceb4966_16037920 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '6871194716318443ce7d191_43527231';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript">
    
    function goHistoryBack(){
        location.replace('member?func=list' );
    }
<?php echo '</script'; ?>
>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <?php
$__section_usr_auth_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_auth_item_0_total = $__section_usr_auth_item_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item'] = new Smarty_Variable(array());
if ($__section_usr_auth_item_0_total !== 0) {
for ($__section_usr_auth_item_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] = 0; $__section_usr_auth_item_0_iteration <= $__section_usr_auth_item_0_total; $__section_usr_auth_item_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']++){
?>
                <form action="member?func=delete" method="POST">
                <input type="hidden" name="idx" value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['member_id'];?>
">
                <input type="hidden" name="email" value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['email'];?>
">
                <input type="hidden" name="func" value="delete">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">계정/사용자 삭제</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10">
                                <?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['email'];?>

                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">권한</label>
                                <div class="col-md-10">                        
                                    <?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['auth_name'];?>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">성명</label>
                                <div class="col-md-10">
                                    <?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['usrname'];?>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-10">
                                    정말로 삭제하시겠습니까?
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <button type="submit" style="width:220px" class="btn btn-primary">삭제</button>
                                </div>
                                <div class="col-md-5">
                                    <input readonly class="btn btn-primary"
                                        onclick="goHistoryBack()" value="이전">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
}
}
?>
            </form>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

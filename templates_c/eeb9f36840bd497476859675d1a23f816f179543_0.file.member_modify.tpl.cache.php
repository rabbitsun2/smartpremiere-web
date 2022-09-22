<?php
/* Smarty version 4.1.1, created on 2022-09-10 17:26:58
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\member_modify.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c4a52a106e8_77861283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eeb9f36840bd497476859675d1a23f816f179543' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\member_modify.tpl',
      1 => 1662537086,
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
function content_631c4a52a106e8_77861283 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1553523583631c4a529bd849_27362418';
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
                <form action="member?func=modify" method="POST">
                <?php
$__section_usr_auth_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_auth_item_0_total = $__section_usr_auth_item_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item'] = new Smarty_Variable(array());
if ($__section_usr_auth_item_0_total !== 0) {
for ($__section_usr_auth_item_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] = 0; $__section_usr_auth_item_0_iteration <= $__section_usr_auth_item_0_total; $__section_usr_auth_item_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']++){
?>
                <input type="hidden" name="idx" value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['member_id'];?>
">
                <input type="hidden" name="email" value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['email'];?>
">
                <?php
}
}
?>
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">계정/사용자 수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">권한</label>
                            <div class="col-md-10">
                                <select class="form-select" name="member_auth" style="width:90%;">
                                <?php
$__section_usr_auth_item_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_auth_item_1_total = $__section_usr_auth_item_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item'] = new Smarty_Variable(array());
if ($__section_usr_auth_item_1_total !== 0) {
for ($__section_usr_auth_item_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] = 0; $__section_usr_auth_item_1_iteration <= $__section_usr_auth_item_1_total; $__section_usr_auth_item_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']++){
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['member_auth'];?>
"><?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['auth_name'];?>
</option>
                                <?php
}
}
?>
                                <?php
$__section_member_auth_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_auth_list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_member_auth_2_total = $__section_member_auth_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_member_auth'] = new Smarty_Variable(array());
if ($__section_member_auth_2_total !== 0) {
for ($__section_member_auth_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index'] = 0; $__section_member_auth_2_iteration <= $__section_member_auth_2_total; $__section_member_auth_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index']++){
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['member_auth_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['member_auth_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_member_auth']->value['index'] : null)]['auth_name'];?>
</option>
                                <?php
}
}
?>
                                </select>
                            </div>
                            </div>
                            
                            <?php
$__section_usr_auth_item_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_auth_item_3_total = $__section_usr_auth_item_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item'] = new Smarty_Variable(array());
if ($__section_usr_auth_item_3_total !== 0) {
for ($__section_usr_auth_item_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] = 0; $__section_usr_auth_item_3_iteration <= $__section_usr_auth_item_3_total; $__section_usr_auth_item_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']++){
?>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">이메일</label>
                                <div class="col-md-10">
                                    <?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['email'];?>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">성명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="usrname" type="text" id="html5-text-input" value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['usrname'];?>
" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">신규 비밀번호</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd1" type="password" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">신규 비밀번호 확인</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="passwd2" type="password" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">상태</label>
                                <div class="col-md-10">
                                    <select name="locked" class="form-select">
                                    <?php
$__section_usr_locked_item_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['member_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_locked_item_4_total = $__section_usr_locked_item_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item'] = new Smarty_Variable(array());
if ($__section_usr_locked_item_4_total !== 0) {
for ($__section_usr_locked_item_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index'] = 0; $__section_usr_locked_item_4_iteration <= $__section_usr_locked_item_4_total; $__section_usr_locked_item_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index']++){
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index'] : null)]['locked'];?>
"><?php echo $_smarty_tpl->tpl_vars['member_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_locked_item']->value['index'] : null)]['locked'];?>
</option>
                                    <?php
}
}
?>
                                        <option value="활성">활성</option>
                                        <option value="비활성">비활성</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <button type="submit" style="width:220px" class="btn btn-primary">수정</button>
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

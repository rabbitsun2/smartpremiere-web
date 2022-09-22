<?php
/* Smarty version 4.1.1, created on 2022-09-14 11:19:14
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\machine_modify.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63213a22c5e962_33707064',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d59c1dd6b1d88470d9e3f025f122afba35f71b1' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\machine_modify.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_machine.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63213a22c5e962_33707064 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '156933587263213a2290deb0_04770468';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_machine.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript">
    
    function goHistoryBack(){
        location.replace('machine?func=list' );
    }
<?php echo '</script'; ?>
>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="machine?func=modify" method="POST">
                <?php
$__section_item_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['machine_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_val_0_total = $__section_item_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_item_val'] = new Smarty_Variable(array());
if ($__section_item_val_0_total !== 0) {
for ($__section_item_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] = 0; $__section_item_val_0_iteration <= $__section_item_val_0_total; $__section_item_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']++){
?>
                <input type="hidden" name="machine_id" value="<?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_id'];?>
">
                <input type="hidden" name="uuid" value="<?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['uuid'];?>
">
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">장비/수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">장치명</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="machine_name" value="<?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_name'];?>
">
                            </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">UUID</label>
                                <div class="col-md-10">
                                    <?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['uuid'];?>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">메모</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="memo" maxlength="50" type="text" id="html5-text-input" value="<?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['memo'];?>
" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">상태</label>
                                <div class="col-md-10">
                                    <select name="locked" class="form-select">
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['locked'];?>
"><?php echo $_smarty_tpl->tpl_vars['machine_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['locked'];?>
</option>
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

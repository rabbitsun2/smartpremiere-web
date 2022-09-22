<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:06:20
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\product_modify_box_spec.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631842ecc84087_05605253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc8a2dcf59299de43586a7973330cc40454f6651' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\product_modify_box_spec.tpl',
      1 => 1662531838,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_project_and_product.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631842ecc84087_05605253 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '132139378631842ecc6db99_90149619';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_project_and_product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <?php
$__section_usr_item1_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['box_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_0_total = $__section_usr_item1_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_0_total !== 0) {
for ($__section_usr_item1_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_0_iteration <= $__section_usr_item1_0_total; $__section_usr_item1_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
            <form action="product?func=modify&id=<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['product_id'];?>
&option=box" method="POST" enctype="multipart/form-data">
            <?php
}
}
?>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $_smarty_tpl->tpl_vars['MAX_FILE_SIZE']->value;?>
" />
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">상자 수정</h5>
                    <div class="card-body">        
                        <?php
$__section_usr_item1_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['box_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_1_total = $__section_usr_item1_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_1_total !== 0) {
for ($__section_usr_item1_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_1_iteration <= $__section_usr_item1_1_total; $__section_usr_item1_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
                        <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['product_id'];?>
">
                        <input type="hidden" name="func" value="modify">
                        <input type="hidden" name="srtype" value="submit">
                        <?php
}
}
?>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">상자 유형</label>
                            <div class="col-md-10">
                                <select name="box_type_id" class="form-select">
                                    <?php
$__section_usr_item1_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['box_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_2_total = $__section_usr_item1_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_2_total !== 0) {
for ($__section_usr_item1_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_2_iteration <= $__section_usr_item1_2_total; $__section_usr_item1_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['box_type_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['type_name'];?>
</option>
                                    <?php
}
}
?>
                                    <?php
$__section_usr_item1_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['box_type_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_3_total = $__section_usr_item1_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_3_total !== 0) {
for ($__section_usr_item1_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_3_iteration <= $__section_usr_item1_3_total; $__section_usr_item1_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['box_type_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['box_type_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['box_type_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['type_name'];?>
</option>
                                    <?php
}
}
?>
                                </select>
                            </div>
                        </div>
                        <?php
$__section_usr_item1_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['box_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_4_total = $__section_usr_item1_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_4_total !== 0) {
for ($__section_usr_item1_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_4_iteration <= $__section_usr_item1_4_total; $__section_usr_item1_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">가로</label>
                            <div class="col-md-10">
                                <input class="form-control" name="width" value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['width'];?>
" type="number" min="0" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">세로</label>
                            <div class="col-md-10">
                                <input class="form-control" name="length" type="number" min="0" value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['length'];?>
" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">높이</label>
                            <div class="col-md-10">
                                <input class="form-control" name="height" type="number" min="0" value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['height'];?>
" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">상자 이름</label>
                            <div class="col-md-10">
                                <input class="form-control" name="box_name" value="<?php echo $_smarty_tpl->tpl_vars['box_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['box_name'];?>
" type="text" id="html5-text-input" />
                            </div>
                        </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">수정</button>
                                </div>
                            </div>
                            <?php
}
}
?>
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

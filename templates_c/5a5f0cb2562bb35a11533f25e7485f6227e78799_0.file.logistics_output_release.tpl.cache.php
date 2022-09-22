<?php
/* Smarty version 4.1.1, created on 2022-09-22 14:13:04
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\logistics_output_release.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_632beee063f846_83574413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a5f0cb2562bb35a11533f25e7485f6227e78799' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\logistics_output_release.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_logistics.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_632beee063f846_83574413 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '337018258632beee0620ca9_23895441';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_logistics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['warehouse_rows']->value, 'w_item');
$_smarty_tpl->tpl_vars['w_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['w_item']->value) {
$_smarty_tpl->tpl_vars['w_item']->do_else = false;
?>
                <form action="logistics?func=output&status=w_ok&id=<?php echo $_smarty_tpl->tpl_vars['w_item']->value['id'];?>
" method="POST">
                <input type="hidden" name="w_log_id" value="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['id'];?>
">
                <input type="hidden" name="prev_w_id" value="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['prev_w_id'];?>
">`
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">창고/출고 작업</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">품목코드</label>
                            <div class="col-md-10">
                                <input class="form-control" name="w_id" readonly name="project_id" value="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['w_id'];?>
" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">품목명</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="product_name" readonly type="text" value="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['product_name'];?>
" id="html5-search-input" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">현재 수량</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="prev_cnt" type="number" id="html5-search-input" readonly value="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['current_cnt'];?>
" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">출고 수량</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="release_cnt" type="number" id="html5-search-input" min="0" max="<?php echo $_smarty_tpl->tpl_vars['w_item']->value['current_cnt'];?>
" />
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">등록</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            </form>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

<?php
/* Smarty version 4.1.1, created on 2022-09-07 17:30:44
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\cart_add_page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631856b463c409_00625937',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40f45e0672d55cd27c57d2a9e80b751023799cfa' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\cart_add_page.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631856b463c409_00625937 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1916935926631856b4631d92_27272706';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>  
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">메시지</label>
                        <div class="col-md-10">
                          <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

                        </div>
                      </div>
                      
                    </div>
                    
                    <input type="button" class="btn btn-primary"
                     value="창닫기" onclick="window.close()" style="width:100%;">
                </div>
            </div>

            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

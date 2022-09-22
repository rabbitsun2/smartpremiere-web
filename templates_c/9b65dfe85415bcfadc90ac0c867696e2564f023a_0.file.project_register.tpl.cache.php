<?php
/* Smarty version 4.1.1, created on 2022-09-07 21:22:41
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\project_register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63188d11ce0eb4_66503427',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b65dfe85415bcfadc90ac0c867696e2564f023a' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\project_register.tpl',
      1 => 1662108850,
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
function content_63188d11ce0eb4_66503427 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '197401385163188d11cd8099_58114374';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_project_and_product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="project?func=register" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $_smarty_tpl->tpl_vars['MAX_FILE_SIZE']->value;?>
" />
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">프로젝트명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="project_name" type="text" id="html5-text-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">설명</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="description" rows="5" cols="35"></textarea>
                            </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-email-input" class="col-md-2 col-form-label">시작일자</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" name="startdate" id="html5-email-input" />
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-email-input" class="col-md-2 col-form-label">종료일자</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="datetime-local" name="enddate" id="html5-email-input" />
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">파일1</label>
                                <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">파일2</label>
                                <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
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

            </form>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

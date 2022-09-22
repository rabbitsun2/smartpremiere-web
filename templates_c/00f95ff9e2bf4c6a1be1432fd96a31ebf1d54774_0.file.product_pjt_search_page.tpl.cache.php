<?php
/* Smarty version 4.1.1, created on 2022-09-07 20:09:38
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\product_pjt_search_page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63187bf2692919_89223487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00f95ff9e2bf4c6a1be1432fd96a31ebf1d54774' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\product_pjt_search_page.tpl',
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
function content_63187bf2692919_89223487 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '106837616363187bf266a377_79106502';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>  
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <form action="product" method="GET">
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="search" value="project">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 검색</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">검색</label>
                        <div class="col-md-10">
                          <!--<input class="form-control" type="search" list="datalistOptions" value="검색 ..." id="html5-search-input" />-->
                          <input class="form-control" name="keyword" type="search" value="검색 ..." id="html5-search-input" />
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">검색</button><br>
                    <input type="button" class="btn btn-primary"
                     value="창닫기" onclick="window.close()" style="width:100%;">
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                </div>
            </div>

            </form>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

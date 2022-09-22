<?php
/* Smarty version 4.1.1, created on 2022-09-10 13:29:07
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\board\paging.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c1293cab749_17574343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfed8c6e8e69bc63df6d91beab751cde414b257c' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\board\\paging.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631c1293cab749_17574343 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1368024416631c1293c1ba45_95596032';
?>

<!-- Basic Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item first">
            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['pagingObj']->value['firstPageNo'];
echo $_smarty_tpl->tpl_vars['fn']->value;?>
">
            <i class="tf-icon bx bx-chevrons-left"></i>
            </a>
        </li>
        <li class="page-item prev">
            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['pagingObj']->value['prevPageNo'];
echo $_smarty_tpl->tpl_vars['fn']->value;?>
">
            <i class="tf-icon bx bx-chevron-left"></i></a>
        </li>

        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['pagingObj']->value['endPageNo']+1 - ($_smarty_tpl->tpl_vars['pagingObj']->value['startPageNo']) : $_smarty_tpl->tpl_vars['pagingObj']->value['startPageNo']-($_smarty_tpl->tpl_vars['pagingObj']->value['endPageNo'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['pagingObj']->value['startPageNo'], $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <?php if ($_smarty_tpl->tpl_vars['i']->value === $_smarty_tpl->tpl_vars['pagingObj']->value['pageNo']) {?>
                <li class="page-item active">
                    <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;
echo $_smarty_tpl->tpl_vars['fn']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;
echo $_smarty_tpl->tpl_vars['fn']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
                </li>
            <?php }?>
        <?php }
}
?>
        <li class="page-item next">
            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['pagingObj']->value['nextPageNo'];
echo $_smarty_tpl->tpl_vars['fn']->value;?>
">
            <i class="tf-icon bx bx-chevron-right"></i>
            </a>
        </li>
        <li class="page-item last">
            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['pagingObj']->value['finalPageNo'];
echo $_smarty_tpl->tpl_vars['fn']->value;?>
">
            <i class="tf-icon bx bx-chevrons-right"></i></a>
        </li>
    <ul>
</nav><?php }
}

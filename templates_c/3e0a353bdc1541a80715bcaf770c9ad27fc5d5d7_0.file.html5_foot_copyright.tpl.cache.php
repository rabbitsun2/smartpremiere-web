<?php
/* Smarty version 4.1.1, created on 2022-09-10 13:29:07
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\board\html5_foot_copyright.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c1293d24ed2_07022062',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e0a353bdc1541a80715bcaf770c9ad27fc5d5d7' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\board\\html5_foot_copyright.tpl',
      1 => 1662263030,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631c1293d24ed2_07022062 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '662148374631c1293d0d632_12751709';
?>
<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
        ©
        <?php echo '<script'; ?>
>
        document.write(new Date().getFullYear());
        <?php echo '</script'; ?>
>
        , Smart Premiere(스마트 프리미어), XOR파이.<br>
        접속시간: <?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['service_mode']->value;?>

    </div>
    </div>
</footer>
<!-- / Footer --><?php }
}

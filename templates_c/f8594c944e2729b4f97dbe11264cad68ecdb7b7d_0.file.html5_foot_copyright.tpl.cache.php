<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:11:49
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\html5_foot_copyright.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63184435dbc0a2_63352566',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8594c944e2729b4f97dbe11264cad68ecdb7b7d' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\html5_foot_copyright.tpl',
      1 => 1662263038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63184435dbc0a2_63352566 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '58635804963184435da64a0_08270564';
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

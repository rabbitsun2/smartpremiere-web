<?php
/* Smarty version 4.1.1, created on 2022-09-07 17:30:49
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\logistics_output_barcode_bag_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631856b9a93f59_03017955',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '33216ae04b2532cd29a019ed80cf9c1f5a624ae8' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\logistics_output_barcode_bag_view.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_631856b9a93f59_03017955 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1301498427631856b9a84aa5_43308346';
?>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
  	<?php echo '<script'; ?>
 src="../../library/jquery/jquery-3.6.0.js"><?php echo '</script'; ?>
>
  	<?php echo '<script'; ?>
 src="../../library/jquery_barcode/jquery-barcode.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" href="../../css/style_barcode.css">
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">
</head>
<body>
<?php $_smarty_tpl->_assignInScope('foo', 1);
$__section_m_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['w_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_m_val_0_total = $__section_m_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_m_val'] = new Smarty_Variable(array());
if ($__section_m_val_0_total !== 0) {
for ($__section_m_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] = 0; $__section_m_val_0_iteration <= $__section_m_val_0_total; $__section_m_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']++){
?>
<table class="barcode_tbl">
	<tr>
		<td class="td_header">
			창고번호
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['id'];?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			프로젝트/제품번호
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['project_id'];?>
 / <?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['product_id'];?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			항목명
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['project_name'];?>
 / <?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['product_name'];?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			바코드
		</td>
		<td class="td_content">
			<div class="bcTarget<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['id'];?>
_1" style="margin-top:30px;"></div>
		</td>
	</tr>
	<tr>
		<td class="td_header">
			QR코드
		</td>
		<td class="td_content">
			<div class="bcTarget<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['id'];?>
_5" style="margin-top:30px;"></div>
		</td>
	</tr>
	<tr>
		<td class="td_header">
			생성일자
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['regidate'];?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			IP주소
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['ip'];?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			수량
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['current_cnt'];?>

		</td>
	</tr>
</table>
	<br>
	<?php if ($_smarty_tpl->tpl_vars['foo']->value%3 === 0) {?>
		<br>
	<?php }?>
	<?php $_smarty_tpl->_assignInScope('foo', $_smarty_tpl->tpl_vars['foo']->value+1);?>

<?php
}
}
?>
<!--<div class="bcTarget1" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget2" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget3" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget4" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget5" style="margin-top:30px;"></div>-->

<?php echo '<script'; ?>
 type="text/javascript">
	<?php echo $_smarty_tpl->tpl_vars['barcode1']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['barcode2']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['barcode3']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['barcode4']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['barcode5']->value;?>

<?php echo '</script'; ?>
>

</body>
</html><?php }
}

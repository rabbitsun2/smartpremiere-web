<?php
/* Smarty version 4.1.1, created on 2022-09-07 17:29:46
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\logistics_output_barcode_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_6318567a2320a2_18158540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc28322c4179406eab469e7b0348fbd078867f0e' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\logistics_output_barcode_view.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6318567a2320a2_18158540 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '4569672506318567a222719_15313629';
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

<?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['w_count']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['w_count']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;?>
<table class="barcode_tbl">
	<tr>
		<td class="td_header">
			창고번호
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_id']->value;?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			제품번호
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_product_id']->value;?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			항목명
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_product_name']->value;?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			바코드
		</td>
		<td class="td_content">
			<div class="bcTarget1" style="margin-top:30px;"></div>
		</td>
	</tr>
	<tr>
		<td class="td_header">
			QR코드
		</td>
		<td class="td_content">
			<div class="bcTarget5" style="margin-top:30px;"></div>
		</td>
	</tr>
	<tr>
		<td class="td_header">
			생성일자
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_create_date']->value;?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			IP주소
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_ip']->value;?>
 / <?php echo $_smarty_tpl->tpl_vars['foo']->value;?>

		</td>
	</tr>
	<tr>
		<td class="td_header">
			수량
		</td>
		<td class="td_content">
			<?php echo $_smarty_tpl->tpl_vars['w_i_count']->value;?>

		</td>
	</tr>
</table>
	<br>
	<?php if ($_smarty_tpl->tpl_vars['foo']->value%3 === 0) {?>
		<br>
	<?php }
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

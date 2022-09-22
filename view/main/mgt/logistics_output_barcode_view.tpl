<html>
<head>
	<title>{$title}</title>
  	<script src="../../library/jquery/jquery-3.6.0.js"></script>
  	<script src="../../library/jquery_barcode/jquery-barcode.js"></script>
	<link rel="stylesheet" href="../../css/style_barcode.css">
    <link href="../../dist/fonts/NanumGothic/fonts.css" rel="stylesheet">
</head>
<body>

{for $foo=1 to $w_count}
<table class="barcode_tbl">
	<tr>
		<td class="td_header">
			창고번호
		</td>
		<td class="td_content">
			{$w_id}
		</td>
	</tr>
	<tr>
		<td class="td_header">
			제품번호
		</td>
		<td class="td_content">
			{$w_product_id}
		</td>
	</tr>
	<tr>
		<td class="td_header">
			항목명
		</td>
		<td class="td_content">
			{$w_product_name}
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
			{$w_create_date}
		</td>
	</tr>
	<tr>
		<td class="td_header">
			IP주소
		</td>
		<td class="td_content">
			{$w_ip} / {$foo}
		</td>
	</tr>
	<tr>
		<td class="td_header">
			수량
		</td>
		<td class="td_content">
			{$w_i_count}
		</td>
	</tr>
</table>
	<br>
	{if $foo % 3 === 0}
		<br>
	{/if}
{/for}
<!--<div class="bcTarget1" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget2" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget3" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget4" style="margin-top:30px;"></div>-->
<!--<div class="bcTarget5" style="margin-top:30px;"></div>-->

<script type="text/javascript">
	{$barcode1}
	{$barcode2}
	{$barcode3}
	{$barcode4}
	{$barcode5}
</script>

</body>
</html>
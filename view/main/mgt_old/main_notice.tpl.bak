{include file="header.tpl"}

<h3 class="sub_title">실시간 현황</h3>
<hr class="sub_hr">
<table>
	<tr>
		<td style="width:450px;">
			<div class="chart_title">입출고 현황</div>
			<hr class="chart_hr">
			<div class="chart_range_date">기간: {$startDate} ~ {$endDate}</div>
			<br>
			<div id='chart1'></div>
		</td>
		<td style="width:450px;">
			<div class="chart_title">장비 가동 현황</div>
			<hr class="chart_hr">
			<div class="chart_range_date">기간: {$startDate} ~ {$endDate}</div>
			<br>
			<div id='chart2'></div>
		</td>
	</tr>
</table>

<!-- 차트 -->
<script type="text/javascript">
	var generate1 = function () { 
		return c3.generate({
			bindto: '#chart1',
			data: {
			columns: [
				['입고', {$sum_of_input}],
				['출고', {$sum_of_output}]
			],
			type: 'bar'
			},
			bar: {
			space: 0.25
			}
		}); 
	},
	chart1 = generate1();
	
	var generate2 = function () { 
		return c3.generate({
			bindto: '#chart2',
			data: {
			columns: [
				['로봇팔1', 30, 200, 100],
				['로봇팔2', 0, 0, 0]
			],
			type: 'bar'
			},
			bar: {
			space: 0.25
			}
		}); 
	},
	chart2 = generate2();
	
</script>
				
{include file="footer.tpl"}
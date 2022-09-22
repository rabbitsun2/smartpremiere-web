{include file="header.tpl"}

<h3 class="sub_title">장비(상태) / 충격감지 센서</h3>
<hr class="sub_hr">
<br>

<form action="machine" method="GET">
<input type="hidden" name="type" value="sensor">
<input type="hidden" name="func" value="list">
<input type="hidden" name="sort" value="shock">
<table class="item_status_tbl">
	<tr>
		<td style="width:15%;">
			장비선택
		</td>
		<td>
			<div align="left">
			<select name="machine_id" style="width:30%;">
			{section name=m_val loop=$currentMachine}
				<option value="{$currentMachine[m_val].machine_id}">{$currentMachine[m_val].machine_name}</option>
			{/section}
            {section name=machine_val loop=$machineList}
                <option value="{$machineList[machine_val].machine_id}">{$machineList[machine_val].machine_name}</option>
            {/section}
			</select>
			</div>
		</td>
	</tr>
	<tr>
		<td>일자
		<td>
			<div align="left">
			<input type="datetime-local" name="startdate" style="width:30%;" value="{$startdate}"> ~ 
			<input type="datetime-local" name="enddate" style="width:30%;" value="{$enddate}">
			</div>
		</td>
	</tr>
	<tr>
		<td>
		<td>
			<input class="ui-button ui-widget ui-corner-all btn_submit" type="submit" 
					value="선택" style="width:90%; height:45px;">
		</td>
	</tr>
</table>
</form>
<br>
<table class="item_status_tbl">
	<thead>
		<tr>
			<th style="width:10%">
				번호
			</th>
			<th style="width:15%">
				장치번호/장치명
			</th>
			<th>
				메시지
			</th>
			<th style="width:15%">
				등록일자
			</th>
			<th style="width:15%">
				IP주소
			</th>
		</tr>
	</thead>
	<tbody>
		{section name=shock_val loop=$shockList}
		<tr>
			<td>
				{$shockList[shock_val].id}
			</td>
			<td>
				{$shockList[shock_val].machine_id}/{$shockList[shock_val].machine_name}
			</td>
			<td>
				{$shockList[shock_val].message}
			</td>
			<td>
				{$shockList[shock_val].regidate}
			</td>
			<td>
				{$shockList[shock_val].ip}
			</td>
		</tr>
		{/section}
	</tbody>
</table>

<div style="text-align:center;">
<!-- 페이징 영역 -->
{include file="paging.tpl"}
</div>

{include file="footer.tpl"}
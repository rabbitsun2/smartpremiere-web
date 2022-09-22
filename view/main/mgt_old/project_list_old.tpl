{include file="header.tpl"}

	<script type="text/javascript">
	  	var openWin;
		function openChild(id){

			var popupWidth = 680;
			var popupHeight = 350;

			var popupX = (window.screen.width / 2) - (popupWidth / 2);
			// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

			var popupY= (window.screen.height / 2) - (popupHeight / 2);
			// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

	    	// window.name = "부모창 이름";
			window.name = "parentForm";
			// window.open("open할 window", "자식창 이름", "팝업창 옵션");
			openWin = window.open("project?func=list&id=" + id + "&option=detail_view" ,
		        "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
				"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
		}

		function goModify(id){
			location.replace('project?func=modify&id=' + id );
		}

		function goDelete(id){
			if ( confirm ( id + '번 프로젝트를 삭제하시겠습니까?') == true ){
				location.replace('project?func=delete&id=' + id );
			}
			else{
				return;
			}
		}

	</script>

				<h3 class="sub_title">프로젝트(제품) / 프로젝트 현황</h3>
				<hr class="sub_hr">

<table class="item_status_tbl">
	<thead>
		<tr>
			<th style="width:10%">
				프로젝트번호
			</th>
			<th colspan="3" style="width:60%">
				프로젝트명
			</th>
			<th>
				비고
			</th>
		</tr>
	</thead>
	<tbody>
		{section name=pjt_list_item loop=$projectList}
		<tr>
			<td>
				{$projectList[pjt_list_item].project_id}
			</td>
			<td colspan="3">
				{$projectList[pjt_list_item].project_name}
			</td>
			<td>
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="상세" onclick="openChild('{$projectList[pjt_list_item].project_id}')">
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="수정" onclick="goModify('{$projectList[pjt_list_item].project_id}')">
				<input class="ui-button ui-widget ui-corner-all" type="button" 
								value="삭제" onclick="goDelete('{$projectList[pjt_list_item].project_id}')">
			</td>
		</tr>
		<tr>
			<td colspan="5" style="background-color:#e2e2e2;">
				<span style="font-weight:bold">설명</span>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				{$projectList[pjt_list_item].description}
			</td>
		</tr>
		<tr>
			<td colspan="5">
				
				<!-- 프로젝트 상세 내용-->
				<table class="project_item_detail_tbl">
					<thead>
						<tr>
							<th>
								시작일자
							</td>
							<th>
								종료일자
							</td>
							<th>
								등록일자
							</td>
						</tr>
						<tr>
							<td>
								{$projectList[pjt_list_item].startdate}
							</td>
							<td>
								{$projectList[pjt_list_item].enddate}
							</td>
							<td>
								{$projectList[pjt_list_item].regidate}
							</td>
						</tr>
					</thead>
				</table>
				
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
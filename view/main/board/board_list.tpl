{include file="html5_header.tpl"}
{include file="menu_board.tpl"}        
{include file="html5_layout.tpl"}

    <script type="text/javascript">
	  	var openWin;

		function goWrite(boardname){
			location.replace('board?func=write&boardname=' + boardname);
		}

		function goView(boardname, id){
			location.replace('board?func=view&boardname=' + boardname + '&id=' + id);
		}

	</script>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">게시판</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%">
                                번호
                            </th>
                            <th style="width:25%">
                                제목
                            </th>
                            <th style="width:25%">
                                성명
                            </th>
                            <th>
                                등록일자
                            </th>
                            <th>
                                조회수
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {foreach $boardList as $u_item}
                        <tr>
                            <td>
                                {$u_item.article_id}
                            </td>
                            <td>
                                <a href="javascript:goView('{$boardname}', '{$u_item.article_id}');">{$u_item.subject}</a>
                            </td>
                            <td>
                                {$u_item.nickname}
                            </td>
                            <td>
                                {$u_item.regidate}
                            </td>
                            <td>
                                {$u_item.cnt}
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                  </table>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>

                
                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    {include file="paging.tpl"}
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <a href="javascript:goWrite('notice');" class="btn btn-primary">등록</a>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
{include file="html5_header.tpl"}
{include file="menu_board.tpl"}        
{include file="html5_layout.tpl"}

    <script type="text/javascript">

		function goList(boardname){
			location.replace('board?func=list&boardname=' + boardname);
		}

		function goModify(boardname, id){
			location.replace('board?func=modify&boardname=' + boardname + '&id=' + id);
		}

        function goDelete(boardname, id){
            location.replace('board?func=delete&boardname=' + boardname + '&id=' + id);
        }

	</script>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                
                {section name=usr_item1 loop=$board_item}
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">게시물 보기</h5>
                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-2">
                                <label for="html5-text-input" class="col-md-2 col-form-label">번호</label>
                            </div>
                            <div class="col-md-2">
                                {$board_item[usr_item1].article_id}
                            </div>
                            <div class="col-md-3">
                                <label for="html5-text-input" class="col-md-2 col-form-label">조회수</label>
                            </div>
                            <div class="col-md-2">
                                {$board_item[usr_item1].cnt}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-3">
                                <label for="html5-text-input" class="col-md-2 col-form-label">작성자</label>
                            </div>
                            <div class="col-md-2">
                                {$board_item[usr_item1].nickname}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">제목</label>
                            <div class="col-md-10">
                                {$board_item[usr_item1].subject}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">내용</label>
                            <div class="col-md-10">
                                {$board_item[usr_item1].memo}
                            </div>
                        </div>
                                                                                    
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <a href="javascript:goWrite('{$boardname}');" class="btn btn-primary">글쓰기</a>
                                <a href="javascript:goList('{$boardname}');" class="btn btn-primary">목록</a>
                                <a href="javascript:goModify('{$boardname}', '{$board_item[usr_item1].article_id}');" class="btn btn-primary">수정</a>
                                <a href="javascript:goDelete('{$boardname}', '{$board_item[usr_item1].article_id}');" class="btn btn-primary">삭제</a>
                            </div>
                        </div>

                        </div>
                        {/section}

                        <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                {section name=usr_item2 loop=$board_file_item}
                                <tr>
                                    <td style="width:15%;background-color:#e2e2e2;">
                                        파일
                                    </td>
                                    <td>
                                        {$board_file_item[usr_item2].original_name} / {$board_file_item[usr_item2].file_size} 
                                    </td>
                                    <td>
                                        <a href="board?func=download&boardname={$boardname}&uuid={$board_file_item[usr_item2].uuid}">다운로드</a>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table style="width:70%;">
                                            <tr>
                                                <td>
                                                    아이피주소
                                                </td>
                                                <td>
                                                    등록일자
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {$board_file_item[usr_item2].ip}
                                                </td>
                                                <td>
                                                    {$board_file_item[usr_item2].regidate} 
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                {/section}
                            </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
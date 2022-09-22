{include file="html5_header.tpl"}
{include file="menu_board.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                
                {section name=usr_item1 loop=$board_item}
                <form action="board?func=modify&boardname={$boardname}&id={$board_item[usr_item1].article_id}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">게시물 글수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">작성자</label>
                            <div class="col-md-10">
                                <input class="form-control" name="nickname" type="text" readonly value="{$board_item[usr_item1].nickname}" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">제목</label>
                            <div class="col-md-10">
                                <input class="form-control" name="subject" type="text" id="html5-text-input" value="{$board_item[usr_item1].subject}" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">내용</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="memo" rows="3">{$board_item[usr_item1].memo}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">파일1</label>
                            <input class="form-control" type="file" name="usrupload[]" id="formFileMultiple" multiple />
                        </div>
                                   
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">수정</button>
                            </div>
                        </div>

                        </div>
                    </form>
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
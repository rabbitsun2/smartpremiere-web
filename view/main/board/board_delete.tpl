{include file="html5_header.tpl"}
{include file="menu_board.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                
                {section name=usr_item1 loop=$board_item}
                <form action="board?func=delete&boardname={$boardname}&id={$board_item[usr_item1].article_id}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="{$MAX_FILE_SIZE}" />
                <input type="hidden" name="func" value="delete">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">게시물 글 삭제</h5>
                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-2">
                                <label for="html5-text-input" class="col-md-2 col-form-label">번호</label>
                            </div>
                            <div class="col-md-2">
                                {$board_item[usr_item1].article_id}
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
                            <div class="col-md-10">
                                정말로 삭제하시겠습니까?
                            </div>
                        </div>
                                     
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">삭제</button>
                            </div>
                        </div>

                        </div>
                        </form>
                        {/section}

                    </div>
                </div>
                
            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
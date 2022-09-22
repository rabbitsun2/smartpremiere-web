{include file="html5_header.tpl"}  
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 상세</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">프로젝트 번호/프로젝트명</label>
                        <div class="col-md-10">
                          {section name=usr_item loop=$project_item}
                              {$project_item[usr_item].project_id} / {$project_item[usr_item].project_name}
                          {/section}
                        </div>
                      </div>
                      
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                              {section name=usr_item2 loop=$project_file_item}
                              <tr>
                                  <td style="width:15%;background-color:#e2e2e2;">
                                      파일
                                  </td>
                                  <td>
                                      {$project_file_item[usr_item2].original_name} / {$project_file_item[usr_item2].file_size} 
                                  </td>
                                  <td>
                                      <a href="project?func=download&uuid={$project_file_item[usr_item2].uuid}">다운로드</a>
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
                                                  {$project_file_item[usr_item2].ip}
                                              </td>
                                              <td>
                                                  {$project_file_item[usr_item2].regidate} 
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                              {/section}
                            </tbody>
                          </table>
                        </div>
                    
                    <!--<input type="button" class="btn btn-primary"
                     value="창닫기" onclick="window.close()" style="width:100%;">-->
                </div>
            </div>

            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
{include file="html5_header.tpl"}  
          <script type="text/javascript">
              function setParentText(num){
                  //alert( '참' );
                  //alert( document.getElementById("cProject_name_" + num).value );
                  opener.document.getElementById("pInput_project_id").value = document.getElementById("cProject_id_" + num).value;
                  opener.document.getElementById("pInput_project_name").value = document.getElementById("cProject_name_" + num).value;
                  
              }
          </script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">프로젝트/검색 결과</h5>
                <a href="javascript:history.back()">이전으로</a>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:15%">
                                프로젝트 번호
                            </th>
                            <th>
                                프로젝트명
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      {foreach $projectList as $projectitem}
                      <tr>
                          <td>
                              <input type="hidden" id="cProject_id_{$projectitem.project_id}" value="{$projectitem.project_id}">
                              {$projectitem.project_id}
                          </td>
                          <td>
                              <input type="hidden" id="cProject_name_{$projectitem.project_id}" value="{$projectitem.project_name}">
                              <a href="#" onclick="setParentText({$projectitem.project_id})">{$projectitem.project_name}</a>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              <table>
                                  <tr>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          시작일자
                                      </td>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          종료일자
                                      </td>
                                      <td style="width:35%;background-color:#e2e2e2;">
                                          등록일자
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          {$projectitem.startdate}
                                      </td>
                                      <td>
                                          {$projectitem.enddate}
                                      </td>
                                      <td>
                                          {$projectitem.regidate}
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                      {/foreach}
                    </tbody>
                  </table>
                                        
                </div>
                    <input class="btn btn-primary" type="button" value="창닫기" onclick="window.close()">
              </div>

                
                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    {include file="paging.tpl"}
                    </div>
                </div>

            </div>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
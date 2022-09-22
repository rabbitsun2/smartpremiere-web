{include file="html5_header.tpl"}
{include file="menu_machine.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">장비/관리</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:7%">
                                번호
                            </th>
                            <th style="width:25%">
                                장비명
                            </th>
                            <th style="width:25%">
                                UUID
                            </th>
                            <th>
                                메모
                            </th>
                            <th style="width:10%">
                                상태
                            </th>
                            <th style="width:10%">
                                등록일자
                            </th>
                            <th style="width:15%">
                                비고
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        {section name=item_val loop=$machineList}
                        <tr>
                            <td>
                                {$machineList[item_val].machine_id}
                            </td>
                            <td>
                                {$machineList[item_val].machine_name}
                            </td>
                            <td>
                                {$machineList[item_val].uuid}
                            </td>
                            <td>
                                {$machineList[item_val].memo}
                            </td>
                            <td>
                                {$machineList[item_val].locked}
                            </td>
                            <td>
                                {$machineList[item_val].regidate}
                            </td>
                            <td>
                                <a href="machine?func=modify&id={$machineList[item_val].machine_id}">수정</a>, 
                                <a href="machine?func=delete&id={$machineList[item_val].machine_id}">삭제</a>
                            </td>
                        </tr>
                        {/section}
                    </tbody>
                  </table>
                                        
                </div>
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
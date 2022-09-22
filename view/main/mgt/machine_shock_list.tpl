{include file="html5_header.tpl"}
{include file="menu_machine_sensor.tpl"}        
{include file="html5_layout.tpl"}

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">장비(상태)/충격감지 센서</h5>

                    <!-- 검색 영역 -->                    
                    <form action="machine" method="GET">
                    <input type="hidden" name="type" value="sensor">
                    <input type="hidden" name="func" value="list">
                    <input type="hidden" name="sort" value="shock">

                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">장비선택</label>
                        <div class="col-md-7">
                            <select class="form-select" name="machine_id">
                            {section name=m_val loop=$currentMachine}
                                <option value="{$currentMachine[m_val].machine_id}">{$currentMachine[m_val].machine_name}</option>
                            {/section}
                            {section name=machine_val loop=$machineList}
                                <option value="{$machineList[machine_val].machine_id}">{$machineList[machine_val].machine_name}</option>
                            {/section}
                            </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        
                        <label for="html5-search-input" class="col-md-2 col-form-label">일자</label>
                        <div class="col-md-3">                         
                            <input class="form-control" type="datetime-local" name="startdate" value="{$startdate}" id="html5-datetime-local-input">
                        </div>
                        <div class="col-md-1">
                            ~
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="datetime-local" name="enddate" value="{$enddate}" id="html5-datetime-local-input">
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">검색</button>
                        </div>
                      </div>
                    </form>
                    
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                    
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
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
                                <tbody class="table-border-bottom-0">
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
                        </div>
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
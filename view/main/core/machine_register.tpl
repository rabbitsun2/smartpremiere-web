{include file="html5_header.tpl"}
{include file="menu_machine.tpl"}        
{include file="html5_layout.tpl"}
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                            
                <form action="machine?func=register" method="POST">
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">장비/등록</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">장치명</label>
                            <div class="col-md-10">
                                <input class="form-control" name="machine_name" type="text" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">메모</label>
                            <div class="col-md-10">
                                <input class="form-control" name="memo" maxlength="50" type="text" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">상태</label>
                            <div class="col-md-10"> 
                                <select class="form-select" name="locked">
                                    <option value="활성">활성</option>
                                    <option value="비활성">비활성</option>
                                </select>
                            </div>
                        </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">등록</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
{include file="html5_header.tpl"}
{include file="menu_machine.tpl"}        
{include file="html5_layout.tpl"}

<script type="text/javascript">
    
    function goHistoryBack(){
        location.replace('machine?func=list' );
    }
</script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            
                <form action="machine?func=modify" method="POST">
                {section name=item_val loop=$machine_item}
                <input type="hidden" name="machine_id" value="{$machine_item[item_val].machine_id}">
                <input type="hidden" name="uuid" value="{$machine_item[item_val].uuid}">
                <input type="hidden" name="func" value="modify">
                <input type="hidden" name="srtype" value="submit">
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">장비/수정</h5>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">장치명</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="machine_name" value="{$machine_item[item_val].machine_name}">
                            </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">UUID</label>
                                <div class="col-md-10">
                                    {$machine_item[item_val].uuid}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">메모</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="memo" maxlength="50" type="text" id="html5-text-input" value="{$machine_item[item_val].memo}" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-search-input" class="col-md-2 col-form-label">상태</label>
                                <div class="col-md-10">
                                    <select name="locked" class="form-select">
                                        <option value="{$machine_item[item_val].locked}">{$machine_item[item_val].locked}</option>
                                        <option value="활성">활성</option>
                                        <option value="비활성">비활성</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <button type="submit" style="width:220px" class="btn btn-primary">수정</button>
                                </div>
                                <div class="col-md-5">
                                    <input readonly class="btn btn-primary"
                                        onclick="goHistoryBack()" value="이전">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/section}
            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
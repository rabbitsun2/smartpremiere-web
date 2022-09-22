{include file="html5_header.tpl"}  

    <script>
        opener.document.location.reload();
    </script>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">{$title}</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">메시지</label>
                        <div class="col-md-10">
                          {$message}
                        </div>
                      </div>
                      
                    </div>
                    
                    <input type="button" class="btn btn-primary"
                     value="창닫기" onclick="window.close()" style="width:100%;">
                </div>
            </div>

            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
{include file="html5_header.tpl"}  
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            <form action="product" method="GET">
                <input type="hidden" name="func" value="input">
                <input type="hidden" name="search" value="project">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">프로젝트 검색</h5>
                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">검색</label>
                        <div class="col-md-10">
                          <!--<input class="form-control" type="search" list="datalistOptions" value="검색 ..." id="html5-search-input" />-->
                          <input class="form-control" name="keyword" type="search" value="검색 ..." id="html5-search-input" />
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">검색</button><br>
                    <input type="button" class="btn btn-primary"
                     value="창닫기" onclick="window.close()" style="width:100%;">
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                </div>
            </div>

            </form>
            <!-- / Content -->

            {include file="html5_foot_copyright.tpl"}
            
{include file="html5_footer.tpl"}
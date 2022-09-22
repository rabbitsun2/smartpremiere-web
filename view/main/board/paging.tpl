
<!-- Basic Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item first">
            <a class="page-link" href="?page={$pagingObj.firstPageNo}{$fn}">
            <i class="tf-icon bx bx-chevrons-left"></i>
            </a>
        </li>
        <li class="page-item prev">
            <a class="page-link" href="?page={$pagingObj.prevPageNo}{$fn}">
            <i class="tf-icon bx bx-chevron-left"></i></a>
        </li>

        {for $i = $pagingObj.startPageNo to $pagingObj.endPageNo}
            {if $i eq $pagingObj.pageNo}
                <li class="page-item active">
                    <a class="page-link" href="?page={$i}{$fn}">{$i}</a>
                </li>
            {else}
                <li class="page-item">
                    <a class="page-link" href="?page={$i}{$fn}">{$i}</a>
                </li>
            {/if}
        {/for}
        <li class="page-item next">
            <a class="page-link" href="?page={$pagingObj.nextPageNo}{$fn}">
            <i class="tf-icon bx bx-chevron-right"></i>
            </a>
        </li>
        <li class="page-item last">
            <a class="page-link" href="?page={$pagingObj.finalPageNo}{$fn}">
            <i class="tf-icon bx bx-chevrons-right"></i></a>
        </li>
    <ul>
</nav>
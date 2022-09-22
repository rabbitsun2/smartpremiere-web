<div class="paginate">
    <a href="?page={$pagingObj.firstPageNo}{$fn}" class="first">처음 페이지</a>
    <a href="?page={$pagingObj.prevPageNo}{$fn}" class="prev">이전 페이지</a>
    <span>
        {for $i = $pagingObj.startPageNo to $pagingObj.endPageNo}
            {if $i === $pagingObj.pageNo}
                <a href="?page={$i}{$fn}" class="choice">{$i}</a>
            {else}
                <a href="?page={$i}{$fn}">{$i}</a>
            {/if}
        {/for}
    </span>
    <a href="?page={$pagingObj.nextPageNo}{$fn}" class="next">다음 페이지</a>
    <a href="?page={$pagingObj.finalPageNo}{$fn}" class="last">마지막 페이지</a>
</div>
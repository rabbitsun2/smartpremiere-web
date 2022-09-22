<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:06:19
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\product_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631842eb4d6ec7_46283391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5af51aa89d8e5e14f925f26c511c113b89500220' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\product_list.tpl',
      1 => 1662523363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_project_and_product.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631842eb4d6ec7_46283391 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1596543987631842eb47f7c9_79127319';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_project_and_product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript">

        /*
	  	var openWin;

		function goDetailView(id){

			var popupWidth = 870;
			var popupHeight = 550;

			var popupX = (window.screen.width / 2) - (popupWidth / 2);
			// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

			var popupY= (window.screen.height / 2) - (popupHeight / 2);
			// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

	    	// window.name = "부모창 이름";
			window.name = "parentForm";
			// window.open("open할 window", "자식창 이름", "팝업창 옵션");
			openWin = window.open("product?func=list&id=" + id + "&option=detail_view" ,
		        "childForm", "width=" + popupWidth + ", height=" + popupHeight + 
				"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");
		}
        */

        function goDetailView(id){
            $('#my_frame').attr('src', 'product?func=list&id=' + id + '&option=detail_view');
            $('#modalCenter').modal('show');
        }

		function goModify(id){
			location.replace('product?func=modify&id=' + id);
		}

		function goDelete(id){

			if ( confirm ( id + '번 제품을 삭제하시겠습니까?') == true ){
				location.replace('product?func=delete&id=' + id );
			}
			else{
				return;
			}

		}

		function goBox(id){
			location.replace('product?func=modify&id=' + id + '&option=box');
		}

	<?php echo '</script'; ?>
>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">프로젝트/제품 현황</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%">
                                제품번호
                            </th>
                            <th style="width:25%">
                                제품명
                            </th>
                            <th style="width:25%">
                                설명
                            </th>
                            <th>
                                기능
                            </th>
                            <th>
                                등록일자
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productList']->value, 'u_item');
$_smarty_tpl->tpl_vars['u_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['u_item']->value) {
$_smarty_tpl->tpl_vars['u_item']->do_else = false;
?>
                        <tr>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_id'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_name'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['description'];?>

                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:goDetailView(<?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_id'];?>
);">
                                        <i class="bx bx-edit-alt me-2"></i> 상세</a>
                                    <a class="dropdown-item" href="javascript:goModify(<?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_id'];?>
);">
                                        <i class="bx bx-edit-alt me-2"></i> 수정</a>
                                    <a class="dropdown-item" href="javascript:goDelete(<?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_id'];?>
);">
                                        <i class="bx bx-trash me-2"></i> 삭제</a>
                                    <a class="dropdown-item" href="javascript:goBox(<?php echo $_smarty_tpl->tpl_vars['u_item']->value['product_id'];?>
);">
                                        <i class="bx bx-trash me-2"></i> 상자</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['regidate'];?>

                            </td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                  </table>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">제품 상세</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="닫기"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id='my_frame' style="width:100%;height:400px"></iframe>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        닫기
                    </button>
                    </div>
                </div>
                </div>
            </div>
                
                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    <?php $_smarty_tpl->_subTemplateRender("file:paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

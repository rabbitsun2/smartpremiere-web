<?php
/* Smarty version 4.1.1, created on 2022-09-07 20:22:03
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\logistics_input_search_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63187edb892798_28689417',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f3c136469ced3a2c9bd499c5128dc1415218386' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\logistics_input_search_result.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63187edb892798_28689417 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '16730328063187edb87cce5_45787281';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>  
          
    <?php echo '<script'; ?>
 type="text/javascript">
        
        var openWin;

		function openChild(id){

			var popupWidth = 680;
			var popupHeight = 350;

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

        function setParentText(num){
            opener.document.getElementById("pInput_productCode").value = document.getElementById("cProduct_id_" + num).value
            opener.document.getElementById("pInput_productName").value = document.getElementById("cProduct_name_" + num).value
        }

	<?php echo '</script'; ?>
>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">제품/검색 결과</h5>
                <a href="javascript:history.back()">이전으로</a>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%" class="head">
                                품목코드
                            </th>
                            <th style="width:20%" class="head">
                                품목명
                            </th>
                            <th style="width:25%" class="head">
                                설명
                            </th>
                            <th class="head">
                                기능
                            </th>
                            <th style="width:15%" class="head">
                                등록일자
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productList']->value, 'productitem');
$_smarty_tpl->tpl_vars['productitem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productitem']->value) {
$_smarty_tpl->tpl_vars['productitem']->do_else = false;
?>
                        <tr>
                            <td>
                                <input type="hidden" id="cProduct_id_<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>
">
                                <?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>

                            </td>
                            <td>
                                <input type="hidden" id="cProduct_name_<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_name'];?>
">
                                <a href="#" onclick="setParentText(<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_name'];?>
</a>
                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['productitem']->value['description'];?>

                            </td>
                            <td>
                                <a href="#" onclick="openChild(<?php echo $_smarty_tpl->tpl_vars['productitem']->value['product_id'];?>
)">상세보기</a>
                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['productitem']->value['regidate'];?>

                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                  </table>
                                        
                </div>
              </div>

                <div style="text-align:center;">
                <!-- 페이징 영역 -->
                <?php $_smarty_tpl->_subTemplateRender("file:paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                </div>

            <input class="btn btn-primary" type="button" value="창닫기" onclick="window.close()">

            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

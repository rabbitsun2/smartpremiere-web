<?php
/* Smarty version 4.1.1, created on 2022-09-07 17:30:47
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\logistics_output_barcode_bag_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631856b707b196_93000360',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7566ce734f78ca6e210c91131a5a4959c521f69c' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\logistics_output_barcode_bag_list.tpl',
      1 => 1662445307,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_logistics.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631856b707b196_93000360 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '305928630631856b706a0f1_92463435';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_logistics.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript">

	var openWin;
	
	function goCartRemove(w_id){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("logistics?func=cart&w_id=" + w_id + "&option=remove" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");

		
	}

	
	function goCartAllRemove(){

		var popupWidth = 680;
		var popupHeight = 350;

		var popupX = (window.screen.width / 2) - (popupWidth / 2);
		// 만들 팝업창 width 크기의 1/2 만큼 보정값으로 빼주었음

		var popupY= (window.screen.height / 2) - (popupHeight / 2);
		// 만들 팝업창 height 크기의 1/2 만큼 보정값으로 빼주었음

		// window.name = "부모창 이름";
		window.name = "parentForm";
		// window.open("open할 window", "자식창 이름", "팝업창 옵션");
		openWin = window.open("logistics?func=cart&w_id=all&option=remove&barcodeKey=<?php echo $_smarty_tpl->tpl_vars['barcode_token']->value;?>
" ,
			"childForm", "width=" + popupWidth + ", height=" + popupHeight + 
			"left="+ popupX + ", top=" + popupY + ", resizable = no, scrollbars = no");

		
	}

<?php echo '</script'; ?>
>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">창고/출고 - 바코드(QR) 장바구니</h5>

                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">기능</label>
                        <div class="col-md-7">
                            <a href="logistics?func=barcode&option=print&barcodeKey=<?php echo $_smarty_tpl->tpl_vars['barcode_token']->value;?>
" class="btn btn-primary">바코드 출력</a>
                            <a href="#" onclick="goCartAllRemove()" class="btn btn-primary">내용 비우기</a>
                            <a href="logistics?func=output" class="btn btn-primary">전체보기</a>
                        </div>
                      </div>
                    </form>
                                        
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
                                            프로젝트/제품번호
                                        </th>
                                        <th style="width:35%">
                                            프로젝트명/품목명
                                        </th>
                                        <th>
                                            수량
                                        </th>
                                        <th style="width:15%">
                                            현재유형
                                        </th>
                                        <th style="width:10%">
                                            등록일자
                                        </th>
                                        <th style="width:10%">
                                            비고
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
$__section_m_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result_rows']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_m_val_0_total = $__section_m_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_m_val'] = new Smarty_Variable(array());
if ($__section_m_val_0_total !== 0) {
for ($__section_m_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] = 0; $__section_m_val_0_iteration <= $__section_m_val_0_total; $__section_m_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']++){
?>
                                    <tr>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['id'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['project_id'];?>
 / <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['product_id'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['project_name'];?>
 / <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['product_name'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['current_cnt'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['current_type'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['regidate'];?>

                                        </td>
                                        <td>
                                            <a href="#" onclick="goCartRemove(<?php echo $_smarty_tpl->tpl_vars['result_rows']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['id'];?>
)">삭제</a>
                                        </td>
                                    </tr>
                                    <?php
}
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

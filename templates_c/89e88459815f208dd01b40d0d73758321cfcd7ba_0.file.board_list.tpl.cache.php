<?php
/* Smarty version 4.1.1, created on 2022-09-10 13:29:07
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\board\board_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c1293adcfd3_58467974',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89e88459815f208dd01b40d0d73758321cfcd7ba' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\board\\board_list.tpl',
      1 => 1662271754,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_board.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631c1293adcfd3_58467974 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1814923581631c129398d2b8_05483014';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_board.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript">
	  	var openWin;

		function goWrite(boardname){
			location.replace('board?func=write&boardname=' + boardname);
		}

		function goView(boardname, id){
			location.replace('board?func=view&boardname=' + boardname + '&id=' + id);
		}

	<?php echo '</script'; ?>
>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">게시판</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:10%">
                                번호
                            </th>
                            <th style="width:25%">
                                제목
                            </th>
                            <th style="width:25%">
                                성명
                            </th>
                            <th>
                                등록일자
                            </th>
                            <th>
                                조회수
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['boardList']->value, 'u_item');
$_smarty_tpl->tpl_vars['u_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['u_item']->value) {
$_smarty_tpl->tpl_vars['u_item']->do_else = false;
?>
                        <tr>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['article_id'];?>

                            </td>
                            <td>
                                <a href="javascript:goView('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['u_item']->value['article_id'];?>
');"><?php echo $_smarty_tpl->tpl_vars['u_item']->value['subject'];?>
</a>
                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['nickname'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['regidate'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['u_item']->value['cnt'];?>

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
                </div>
              </div>

                
                <div class="row justify-content-end">
                    <div class="col-sm-7">
                    <!-- 페이징 영역 -->
                    <?php $_smarty_tpl->_subTemplateRender("file:paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <a href="javascript:goWrite('notice');" class="btn btn-primary">등록</a>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

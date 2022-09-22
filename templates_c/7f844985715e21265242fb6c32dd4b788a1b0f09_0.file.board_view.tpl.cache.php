<?php
/* Smarty version 4.1.1, created on 2022-09-10 13:29:11
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\board\board_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_631c1297c21154_49305686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f844985715e21265242fb6c32dd4b788a1b0f09' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\board\\board_view.tpl',
      1 => 1662358196,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_board.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_631c1297c21154_49305686 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1123606471631c1297baf734_23951868';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_board.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript">

		function goList(boardname){
			location.replace('board?func=list&boardname=' + boardname);
		}

		function goModify(boardname, id){
			location.replace('board?func=modify&boardname=' + boardname + '&id=' + id);
		}

        function goDelete(boardname, id){
            location.replace('board?func=delete&boardname=' + boardname + '&id=' + id);
        }

	<?php echo '</script'; ?>
>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                
                <?php
$__section_usr_item1_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['board_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item1_0_total = $__section_usr_item1_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item1'] = new Smarty_Variable(array());
if ($__section_usr_item1_0_total !== 0) {
for ($__section_usr_item1_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] = 0; $__section_usr_item1_0_iteration <= $__section_usr_item1_0_total; $__section_usr_item1_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']++){
?>
                <!-- HTML5 Inputs -->
                <div class="card mb-4">
                    <h5 class="card-header">게시물 보기</h5>
                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-2">
                                <label for="html5-text-input" class="col-md-2 col-form-label">번호</label>
                            </div>
                            <div class="col-md-2">
                                <?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['article_id'];?>

                            </div>
                            <div class="col-md-3">
                                <label for="html5-text-input" class="col-md-2 col-form-label">조회수</label>
                            </div>
                            <div class="col-md-2">
                                <?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['cnt'];?>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-3">
                                <label for="html5-text-input" class="col-md-2 col-form-label">작성자</label>
                            </div>
                            <div class="col-md-2">
                                <?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['nickname'];?>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">제목</label>
                            <div class="col-md-10">
                                <?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['subject'];?>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">내용</label>
                            <div class="col-md-10">
                                <?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['memo'];?>

                            </div>
                        </div>
                                                                                    
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <a href="javascript:goWrite('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
');" class="btn btn-primary">글쓰기</a>
                                <a href="javascript:goList('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
');" class="btn btn-primary">목록</a>
                                <a href="javascript:goModify('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['article_id'];?>
');" class="btn btn-primary">수정</a>
                                <a href="javascript:goDelete('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['board_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item1']->value['index'] : null)]['article_id'];?>
');" class="btn btn-primary">삭제</a>
                            </div>
                        </div>

                        </div>
                        <?php
}
}
?>

                        <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                <?php
$__section_usr_item2_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['board_file_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_item2_1_total = $__section_usr_item2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_item2'] = new Smarty_Variable(array());
if ($__section_usr_item2_1_total !== 0) {
for ($__section_usr_item2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] = 0; $__section_usr_item2_1_iteration <= $__section_usr_item2_1_total; $__section_usr_item2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']++){
?>
                                <tr>
                                    <td style="width:15%;background-color:#e2e2e2;">
                                        파일
                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['board_file_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] : null)]['original_name'];?>
 / <?php echo $_smarty_tpl->tpl_vars['board_file_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] : null)]['file_size'];?>
 
                                    </td>
                                    <td>
                                        <a href="board?func=download&boardname=<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
&uuid=<?php echo $_smarty_tpl->tpl_vars['board_file_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] : null)]['uuid'];?>
">다운로드</a>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table style="width:70%;">
                                            <tr>
                                                <td>
                                                    아이피주소
                                                </td>
                                                <td>
                                                    등록일자
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $_smarty_tpl->tpl_vars['board_file_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] : null)]['ip'];?>

                                                </td>
                                                <td>
                                                    <?php echo $_smarty_tpl->tpl_vars['board_file_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_item2']->value['index'] : null)]['regidate'];?>
 
                                                </td>
                                            </tr>
                                        </table>
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

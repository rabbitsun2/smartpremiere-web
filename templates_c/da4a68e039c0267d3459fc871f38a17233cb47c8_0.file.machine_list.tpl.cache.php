<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:29:26
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\core\machine_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63184856c893a7_30284680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da4a68e039c0267d3459fc871f38a17233cb47c8' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\core\\machine_list.tpl',
      1 => 1662108850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_machine.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63184856c893a7_30284680 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '133938826563184856c6b0e7_64169996';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_machine.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                <h5 class="card-header">장비/관리</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                        <tr>
                            <th style="width:7%">
                                번호
                            </th>
                            <th style="width:25%">
                                장비명
                            </th>
                            <th style="width:25%">
                                UUID
                            </th>
                            <th>
                                메모
                            </th>
                            <th style="width:10%">
                                상태
                            </th>
                            <th style="width:10%">
                                등록일자
                            </th>
                            <th style="width:15%">
                                비고
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
$__section_item_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['machineList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_val_0_total = $__section_item_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_item_val'] = new Smarty_Variable(array());
if ($__section_item_val_0_total !== 0) {
for ($__section_item_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] = 0; $__section_item_val_0_iteration <= $__section_item_val_0_total; $__section_item_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']++){
?>
                        <tr>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_id'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_name'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['uuid'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['memo'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['locked'];?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['regidate'];?>

                            </td>
                            <td>
                                <a href="machine?func=modify&id=<?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_id'];?>
">수정</a>, 
                                <a href="machine?func=delete&id=<?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item_val']->value['index'] : null)]['machine_id'];?>
">삭제</a>
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

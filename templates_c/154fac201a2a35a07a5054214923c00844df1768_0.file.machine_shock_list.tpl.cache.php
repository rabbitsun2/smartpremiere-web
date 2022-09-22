<?php
/* Smarty version 4.1.1, created on 2022-09-07 16:29:29
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\machine_shock_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_63184859e048d9_08876948',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '154fac201a2a35a07a5054214923c00844df1768' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\machine_shock_list.tpl',
      1 => 1662197038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_machine_sensor.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:paging.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_63184859e048d9_08876948 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '211792127063184859de5457_83235751';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_machine_sensor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <h5 class="card-header">장비(상태)/충격감지 센서</h5>

                    <!-- 검색 영역 -->                    
                    <form action="machine" method="GET">
                    <input type="hidden" name="type" value="sensor">
                    <input type="hidden" name="func" value="list">
                    <input type="hidden" name="sort" value="shock">

                    <div class="card-body">
                      <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-2 col-form-label">장비선택</label>
                        <div class="col-md-7">
                            <select class="form-select" name="machine_id">
                            <?php
$__section_m_val_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['currentMachine']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_m_val_0_total = $__section_m_val_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_m_val'] = new Smarty_Variable(array());
if ($__section_m_val_0_total !== 0) {
for ($__section_m_val_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] = 0; $__section_m_val_0_iteration <= $__section_m_val_0_total; $__section_m_val_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']++){
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['currentMachine']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['machine_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['currentMachine']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_m_val']->value['index'] : null)]['machine_name'];?>
</option>
                            <?php
}
}
?>
                            <?php
$__section_machine_val_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['machineList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_machine_val_1_total = $__section_machine_val_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_machine_val'] = new Smarty_Variable(array());
if ($__section_machine_val_1_total !== 0) {
for ($__section_machine_val_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index'] = 0; $__section_machine_val_1_iteration <= $__section_machine_val_1_total; $__section_machine_val_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index']++){
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index'] : null)]['machine_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['machineList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_machine_val']->value['index'] : null)]['machine_name'];?>
</option>
                            <?php
}
}
?>
                            </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        
                        <label for="html5-search-input" class="col-md-2 col-form-label">일자</label>
                        <div class="col-md-3">                         
                            <input class="form-control" type="datetime-local" name="startdate" value="<?php echo $_smarty_tpl->tpl_vars['startdate']->value;?>
" id="html5-datetime-local-input">
                        </div>
                        <div class="col-md-1">
                            ~
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="datetime-local" name="enddate" value="<?php echo $_smarty_tpl->tpl_vars['enddate']->value;?>
" id="html5-datetime-local-input">
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">검색</button>
                        </div>
                      </div>
                    </form>
                    
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                    
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
                                            장치번호/장치명
                                        </th>
                                        <th>
                                            메시지
                                        </th>
                                        <th style="width:15%">
                                            등록일자
                                        </th>
                                        <th style="width:15%">
                                            IP주소
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
$__section_shock_val_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['shockList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_shock_val_2_total = $__section_shock_val_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_shock_val'] = new Smarty_Variable(array());
if ($__section_shock_val_2_total !== 0) {
for ($__section_shock_val_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] = 0; $__section_shock_val_2_iteration <= $__section_shock_val_2_total; $__section_shock_val_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']++){
?>
                                    <tr>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['id'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['machine_id'];?>
/<?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['machine_name'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['message'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['regidate'];?>

                                        </td>
                                        <td>
                                            <?php echo $_smarty_tpl->tpl_vars['shockList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shock_val']->value['index'] : null)]['ip'];?>

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

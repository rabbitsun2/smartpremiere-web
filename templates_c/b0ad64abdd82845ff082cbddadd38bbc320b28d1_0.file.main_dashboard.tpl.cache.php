<?php
/* Smarty version 4.1.1, created on 2022-09-22 14:19:20
  from 'C:\wampp\apache2\htdocs\smartLogistics\view\main\mgt\main_dashboard.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.1',
  'unifunc' => 'content_632bf05860c1c9_11892527',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0ad64abdd82845ff082cbddadd38bbc320b28d1' => 
    array (
      0 => 'C:\\wampp\\apache2\\htdocs\\smartLogistics\\view\\main\\mgt\\main_dashboard.tpl',
      1 => 1663823957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html5_header.tpl' => 1,
    'file:menu_dashboard.tpl' => 1,
    'file:html5_layout.tpl' => 1,
    'file:html5_foot_copyright.tpl' => 1,
    'file:html5_footer.tpl' => 1,
  ),
),false)) {
function content_632bf05860c1c9_11892527 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1291757969632bf0585fd436_41779010';
$_smarty_tpl->_subTemplateRender("file:html5_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu_dashboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>        
<?php $_smarty_tpl->_subTemplateRender("file:html5_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript">

      function goBoardView(boardname, id){
        location.replace('board?func=view&boardname=' + boardname + '&id=' + id);
      }

	<?php echo '</script'; ?>
>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">공지사항!</h5>
                          <?php
$__section_usr_auth_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['latest_notice_item']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_usr_auth_item_0_total = $__section_usr_auth_item_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item'] = new Smarty_Variable(array());
if ($__section_usr_auth_item_0_total !== 0) {
for ($__section_usr_auth_item_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] = 0; $__section_usr_auth_item_0_iteration <= $__section_usr_auth_item_0_total; $__section_usr_auth_item_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']++){
?>
                          <p class="mb-4">
                            <span class="fw-bold"><?php echo $_smarty_tpl->tpl_vars['latest_notice_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['subject'];?>
</span><br>
                            <?php echo $_smarty_tpl->tpl_vars['latest_notice_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['memo'];?>

                          </p>
                          <?php
}
}
?>
                          <a href="javascript:goBoardView('<?php echo $_smarty_tpl->tpl_vars['boardname']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['latest_notice_item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_usr_auth_item']->value['index'] : null)]['article_id'];?>
');" class="btn btn-sm btn-outline-primary">더 보기</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../../library/sneat-1.0.0/assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="../../library/sneat-1.0.0/assets/illustrations/man-with-laptop-dark.png"
                            data-app-light-img="../../library/sneat-1.0.0/assets/illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../library/sneat-1.0.0/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">폴더 용량</span>
                          <h3 class="card-title mb-2"><?php echo $_smarty_tpl->tpl_vars['sum_of_dirsize']->value;?>
</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>-->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../library/sneat-1.0.0/assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>업무</span>
                          <h3 class="card-title text-nowrap mb-1">4건</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 차트1, 차트2 -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">입출고 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: <?php echo $_smarty_tpl->tpl_vars['periodOfstartDate']->value;?>
 ~ <?php echo $_smarty_tpl->tpl_vars['periodOfendDate']->value;?>
</span>
							          <div style="width:100%;">
                          <canvas id="canvas1" style="height:50%; width:50%"></canvas>
                        </div>
                        <!--<div id='chart1' class="px-2"></div>-->
                      </div>
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">전체 입출고 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: <?php echo $_smarty_tpl->tpl_vars['oneyearOfstartDate']->value;?>
 ~ <?php echo $_smarty_tpl->tpl_vars['oneyearOfendDate']->value;?>
</span>
                        <canvas id="canvas2"></canvas>
							          <!--<div id='chart2' class="px-2"></div>-->
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../library/sneat-1.0.0/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt4"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="d-block mb-1">사용자 수</span>
                          <h3 class="card-title text-nowrap mb-2"><?php echo $_smarty_tpl->tpl_vars['sum_of_member']->value;?>
명</h3>
                          <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../library/sneat-1.0.0/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">DB 용량</span>
                          <h3 class="card-title mb-2"><?php echo $_smarty_tpl->tpl_vars['sum_of_dbsize']->value;?>
 MB</h3>
                          <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>-->
                        </div>
                      </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                    <div class="col-12 mb-4">
                      
                      </div>
                    </div>
                  </div>
                
                <!-- 입출고 현황 -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">장비 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: <?php echo $_smarty_tpl->tpl_vars['periodOfstartDate']->value;?>
 ~ <?php echo $_smarty_tpl->tpl_vars['periodOfendDate']->value;?>
</span>
							          <!--<div id='chart3' class="px-2"></div>-->
                        <canvas id="canvas3"></canvas>
                      </div>
                      <div class="col-md-6">
                        <h5 class="card-header m-0 me-2 pb-3">전체 장비 현황</h5>
                        <span class="card-header m-0 me-2 pb-3">기간: <?php echo $_smarty_tpl->tpl_vars['oneyearOfstartDate']->value;?>
 ~ <?php echo $_smarty_tpl->tpl_vars['oneyearOfendDate']->value;?>
</span>
							          <!--<div id='chart4' class="px-2"></div>-->
                        <canvas id="canvas4"></canvas>
                      </div>
                    </div>
                  </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <?php $_smarty_tpl->_subTemplateRender("file:html5_foot_copyright.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            
            <!-- 차트 -->
            <?php echo '<script'; ?>
 type="text/javascript">
              
              function createChart1(){
                new Chart(document.getElementById("canvas1"), {
                  type: 'pie',
                  data: {
                      labels: ['입고', '출고'],
                      datasets: [{
                          label: '입고',
                          data: [ <?php echo $_smarty_tpl->tpl_vars['period_of_sum_of_input']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['period_of_sum_of_output']->value;?>
 ],
                          borderColor: ["rgba(51, 153, 255, 1)", "rgba(255, 201, 14, 1)"],
                          backgroundColor: ["rgba(0, 102, 204, 0.5)", "rgba(255, 201, 14, 0.5)"],
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }
            
            function createChart2(){
                new Chart(document.getElementById("canvas2"), {
                  type: 'bar',
                  data: {
                      labels: [
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrOneYearOfmonth']->value, 'u_item');
$_smarty_tpl->tpl_vars['u_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['u_item']->value) {
$_smarty_tpl->tpl_vars['u_item']->do_else = false;
?>
                              '<?php echo $_smarty_tpl->tpl_vars['u_item']->value;?>
',
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      ],
                      datasets: [{
                          label: '입고',
                          data: [ 
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrOneYearOfresultOfinput']->value, 'u_item');
$_smarty_tpl->tpl_vars['u_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['u_item']->value) {
$_smarty_tpl->tpl_vars['u_item']->do_else = false;
?>
                              '<?php echo $_smarty_tpl->tpl_vars['u_item']->value;?>
',
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                          ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '출고',
                          data: [ <?php echo $_smarty_tpl->tpl_vars['oneyear_of_sum_of_output']->value;?>
 ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }

            
              function createChart3(){
                new Chart(document.getElementById("canvas3"), {
                  type: 'bar',
                  data: {
                      labels: ['1', '2', '3'],
                      datasets: [{
                          label: '로봇팔1',
                          data: [ '30', '40', '100' ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '로봇팔2',
                          data: [ '40', '60', '70' ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }
            
            function createChart4(){
                new Chart(document.getElementById("canvas4"), {
                  type: 'bar',
                  data: {
                      labels: ['1', '2', '3'],
                      datasets: [{
                          label: '로봇팔1',
                          data: [ '30', '40', '100' ],
                          borderColor: "rgba(51, 153, 255, 1)",
                          backgroundColor: "rgba(0, 102, 204, 0.5)",
                          fill: true,
                          lineTension: 0
                      },
                      {
                          label: '로봇팔2',
                          data: [ '40', '60', '70' ],
                          borderColor: "rgba(255, 201, 14, 1)",
                          backgroundColor: "rgba(255, 201, 14, 0.5)",
                          fill: true,
                          lineTension: 0
                      }]
                  },
                  options: {
                      responsive: true,
                      title: {
                          display: true,
                          text: '라인 차트 테스트'
                      },
                      tooltips: {
                          mode: 'index',
                          intersect: false,
                      },
                      hover: {
                          mode: 'nearest',
                          intersect: true
                      },
                      scales: {
                          xAxes: [{
                              display: true,
                              scaleLabel: {
                                  display: true,
                                  labelString: 'x축'
                              }
                          }],
                          yAxes: [{
                              display: true,
                              ticks: {
                                  suggestedMin: 0,
                              },
                              scaleLabel: {
                                  display: true,
                                  labelString: 'y축'
                              }
                          }]
                      }
                  }
              });
            }

            createChart1();
            createChart2();
            createChart3();
            createChart4();
            
            <?php echo '</script'; ?>
>

            <!--
            <?php echo '<script'; ?>
 type="text/javascript">
              var generate1 = function () { 
                return c3.generate({
                  bindto: '#chart1',
                  data: {
                  columns: [
                    ['입고', <?php echo $_smarty_tpl->tpl_vars['period_of_sum_of_input']->value;?>
],
                    ['출고', <?php echo $_smarty_tpl->tpl_vars['period_of_sum_of_output']->value;?>
]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart1 = generate1();
              
              var generate2 = function () { 
                return c3.generate({
                  bindto: '#chart2',
                  data: {
                  columns: [
                    ['입고', <?php echo $_smarty_tpl->tpl_vars['oneyear_of_sum_of_input']->value;?>
],
                    ['출고', <?php echo $_smarty_tpl->tpl_vars['oneyear_of_sum_of_output']->value;?>
]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart2 = generate2();

              var generate3 = function () { 
                return c3.generate({
                  bindto: '#chart3',
                  data: {
                  columns: [
                    ['로봇팔1', 30, 200, 100],
                    ['로봇팔2', 0, 0, 0]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart3 = generate3();
                            
              var generate4 = function () { 
                return c3.generate({
                  bindto: '#chart4',
                  data: {
                  columns: [
                    ['로봇팔1', 30, 200, 100],
                    ['로봇팔2', 0, 0, 0]
                  ],
                  type: 'bar'
                  },
                  bar: {
                  space: 0.25
                  }
                }); 
              },
              chart4 = generate4();

            <?php echo '</script'; ?>
>
            -->  

<?php $_smarty_tpl->_subTemplateRender("file:html5_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

<?php if (!defined('THINK_PATH')) exit();?>

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('admin/index/index')?>" class="brand-logo">MyBC</a>
      
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('news/index')?>">公告</a></li>
        <li><a class="waves-effect" href="<?=U('news/instruction')?>">免责声明</a></li>
        <li><a class="waves-effect" href="<?=U('user/usrlist')?>">选手</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
        <li><a class="waves-effect" href="<?=U('score/index')?>">改卷</a></li>
        <li><a class="waves-effect" href="<?=U('result/index')?>">结果</a></li>
      </ul>
      
      
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="fa fa-navicon"></i><!-- <i class="material-icons">menu</i> --></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('news/index')?>">公告</a></li>
        <li><a class="waves-effect" href="<?=U('news/instruction')?>">免责声明</a></li>
        <li><a class="waves-effect" href="<?=U('user/usrlist')?>">选手</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
        <li><a class="waves-effect" href="<?=U('score/index')?>">改卷</a></li>
        <li><a class="waves-effect" href="<?=U('result/index')?>">结果</a></li>
      </ul>
      
    </div>
    </nav>
</block>

  <h2 class="center-align">股票</h2>
  <div class="container" id="escaped">
  <form class="container" action="<?=U('stock/update')?>" enctype="multipart/form-data" method="post">
      <ul class="collapsible popout" data-collapsible="accordion">
        <?php
 $timearr= array("00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00"); foreach ($stocks as $stock) { ?>
          <li>
            <div class="collapsible-header"><?php echo ($stock["stock_name"]); ?><i class="fa fa-line-chart"></i>
            <a class="right" href="<?=U("stock/delete",['id'=>$stock['stock_id']])?>"><i class="fa fa-trash-o"></i></a>
            </div>
            <div class="collapsible-body">
              <div class="container input-field">
                <input id="name<?php echo ($stock["stock_id"]); ?>" name="<?php echo ($stock["stock_id"]); ?>[name]" type="text" class="validate" value="<?php echo ($stock["stock_name"]); ?>">
                <label for="name<?php echo ($stock["stock_id"]); ?>">股票名称</label>
              </div>
              <div class="container input-field">
                <textarea name="<?php echo ($stock["stock_id"]); ?>[bg]" id="discription<?php echo ($stock["stock_id"]); ?>" class="materialize-textarea"><?php echo ($stock["stock_bg"]); ?></textarea>
                <label for="discription<?php echo ($stock["stock_id"]); ?>">股票简介</label>
              </div>
              <div class="container">
                <ul class="collapsible" data-collapsible="accordion">
                <?php foreach ($stock['trend'] as $key => $year){?>
                  <li>
                      <div class="collapsible-header"><?=date("Y年m月d日  H:i",$year['time'])?>
                        <a class="right" href="<?=U("stock/delete",['id'=>$stock['stock_id'],'time'=>$year['time']])?>"><i class="fa fa-trash-o"></i></a>
                      </div>
                      <div class="collapsible-body">
                          <div class="container">
                            <input type="date" name="<?=$stock['stock_id']?>[trend][<?=$key?>][date]" value="<?=date("Y-m-d",$year['time'])?>" class="datepicker">
                            <div class="container input-field">
                                <select name="<?=$stock['stock_id']?>[trend][<?=$key?>][time]">
                                  <?php foreach ($timearr as $time) { ?>
                                    <option value="<?=$time?>" <?=$time==date('H:i',$year['time'])?"selected":'' ?> ><?=$time?></option>
                                  <?php } ?>
                                </select>
                                <label>选择时间</label>
                            </div>
                            <div class="input-field">
                              <i class="fa fa-rmb prefix amber-text lighten-1"></i>
                              <input id="price<?php echo ($year["time"]); ?>" type="text" name="<?=$stock['stock_id']?>[trend][<?=$key?>][price]" value="<?=$year['price']?>" class="validate">
                              <label for="price<?php echo ($year["time"]); ?>">价格</label>
                            </div>
                            <div class="input-field">
                              <textarea id="news<?php echo ($year["time"]); ?>" name="<?=$stock['stock_id']?>[trend][<?=$key?>][news]" class="materialize-textarea"><?php echo ($year["news"]); ?></textarea>
                              <label for="news<?php echo ($year["time"]); ?>">新闻</label>
                            </div>
                          </div>
                      </div>
                    </li>
                    <?php } ?>
                  </ul>
                  <a class="btn waves-effect waves-light blue accent-3" href="<?=U("stock/add",['id'=>$stock['stock_id']])?>">添加事件
                    <i class="fa fa-plus right"></i>
                  </a>
                  <br/>
                  <br/>
              </div>
            </div>
          </li>
          <?php } ?>
      </ul>
      <div class="container">
        <a class="waves-effect waves-light btn <?=$page=='1'?"disabled":""?>" href="<?=U('stock/index',['page'=>$page-1])?>" >上一页</a>
        <a class="waves-effect waves-light btn <?=$pageMax?"disabled":""?>" href="<?=U('stock/index',['page'=>$page+1])?>">下一页</a>
        <a class="btn waves-effect waves-light light-green darken-2" href="<?=U("stock/add")?>">添加股票
          <i class="fa fa-plus right"></i>
        </a>
        <button class="btn waves-effect waves-light red accent-3" type="submit">保存
          <i class="fa fa-save right"></i>
        </button>
      </div>
    </form>
    <br/>
  </div>

<footer class="page-footer teal">
  
  
  <div class="footer-copyright">
    <div class="container">
    By IT Club: <a class="brown-text text-lighten-3" href="http://www.scieit.tk">www.scieit.tk</a>
    </div>
  </div>
</footer>
  <!--  Scripts-->

  <script>
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
      });
    $(document).ready(function() {
        $('select').material_select();
      });
                
  </script>

<script>
  window.onload=function(){
    $("#preloader").remove();
    $("body").show();
  }
</script>

  <script>
    $(document).ready(function(){
      $('.button-collapse').sideNav();
    });
  </script>

</body>
</html>
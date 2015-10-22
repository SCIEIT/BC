<?php if (!defined('THINK_PATH')) exit();?>
  <link rel="stylesheet" href="/Public/chartist/chartist.min.css">

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('index/index')?>" class="brand-logo"><img id="img" src="/Public/logo.jpg"/></a>
      
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">答题</a></li>
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li>
              <a class="waves-effect collapsible-header">用户</a>
              <div class="collapsible-body" style>
                <ul>
                <li><a href="<?=U('user/password')?>">更改密码</a></li>
                <li><a href="<?=U('home/login/logout')?>">登出</a></li>
                </ul>
              </div>
            </li>
          </ul>
      </li>
      </ul>
      
      
      <ul id="dropdown1" class="dropdown-content">
        <li><a href="<?=U('user/password')?>">更改密码</a></li>
        <li><a href="<?=U('home/login/logout')?>">登出</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="fa fa-navicon"></i><!-- <i class="material-icons">menu</i> --></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">答题</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">用户</a></li>
      </ul>
      
    </div>
    </nav>
</block>

  <div class="container" id="escaped">
  <blockquote class="flow-text">当前账户余额：<?php echo ($money); ?></blockquote>
  <br/>
  <form class="container" action="<?=U('stock/update')?>" enctype="multipart/form-data" method="post">
<!--       <ul class="collapsible popout" data-collapsible="accordion"> -->
        <?php
 foreach ($stocks['stocks'] as $stock) { $ratio=($stock['current']['price']-$stock['last']['price'])/$stock['last']['price'];?>
<!--           <li> -->
            <h4 class=""><?php echo ($stock["stock_name"]); ?>  <i class="fa fa-line-chart"></i></h4>
<!--             </div>
            <div class="collapsible-body"> -->
            <br/>
              <div class="container">
                <div id="chart<?=$stock['stock_id']?>"></div>
              </div>
              <div class="container">
                <h5>股价：<?=isset($stock['current']['time'])?($stock['current']['price'].' ('.date('Y年m月d日 H:i',$stock['current']['time']).')'):'暂未上市'?><span class="badge new <?=$ratio>0?'red': ($ratio==0?'grey':'green')?>"><?=round($ratio ,2)?>%</span></h5>
                <blockquote><?php echo ($stock["current"]["news"]); ?></blockquote>
                <p>已持有：<?php echo ((isset($stock["hold"]) && ($stock["hold"] !== ""))?($stock["hold"]):"0"); ?>股</p>
              </div>
              <div class="input-field col s6">
                        <i class="fa fa-cny prefix"></i>
                        <input id="<?php echo ($stock["stock_id"]); ?>" name="<?php echo ($stock["stock_id"]); ?>" type="number" class="validate">
                        <label for="<?php echo ($stock["stock_id"]); ?>">购买、卖出（购买请用正表示，卖出请用负表示）</label>
                      </div>
              <hr/>
<!--             </div>
          </li> -->
          <?php } ?>
<!--       </ul> -->
      <div class="container">
        <button class="btn waves-effect waves-light red accent-3" type="submit">提交
          <i class="fa fa-bar-chart right"></i>
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

  <script src="/Public/chartist/chartist.min.js"></script>
  <script>
  <?php foreach ($stocks['stocks'] as $key=>$stock) {?>
    $(function() {
          new Chartist.Line('#chart<?=$stock['stock_id']?>', {
            labels: [<?php for($i=1;$i<=count($stock['trend']);++$i){ echo "'$i', "; } ?>],
            series: [{
              name:'<?=$stock['stock_name']?>',
              data: [<?php foreach ($stock['trend'] as $year) { ?>'<?=$year['price']?>',<?php  } ?>]
            },{
              name:'<?=$stock['stock_name']?>',
              data: [<?php foreach ($stock['trend'] as $year) { ?><?=$year['price']?>,<?php  } ?>]
            }
            ]
          }, {
            fullWidth: true,
            chartPadding: {
                right: 40
              },
              lineSmooth: false,
              height:440,
          });
      });
        <?php } ?>
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
      $('#img').css('height',$('#img').parents('nav').height());
    });
  </script>

</body>
</html>
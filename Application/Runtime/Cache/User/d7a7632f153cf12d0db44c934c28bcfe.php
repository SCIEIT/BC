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

	<div id='escaped'>
	<div class="row">
	    <div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
	 		     <div class="activator">
	 		     	<br/>
	      	     	<div class="container">
	      		     	<div class="row">
	      			     	<div class="col s3">
	      			     		<p>当前现金:</p>
	      			     	</div>
	      		     		<div class="col s9">
	      				     	<p><?php echo ($money); ?></p>
	      				    </div>
	      				</div>
	      				<br/>
	      				<div class="row">
	      			     	<div class="col s3">
	      			     		<p>股票市值:</p>
	      			     	</div>
	      		     		<div class="col s9">
	      				     	<p><?php echo ($stock); ?></p>
	      				    </div>
	      				</div>
	      				<br/>
	      				<div class="row">
	      			     	<div class="col s3">
	      			     		<p>总资产:</p>
	      			     	</div>
	      		     		<div class="col s9">
	      				     	<p><?=$money+$stock?></p>
	      				    </div>
	      				</div>
	      				<br/>
	      				<div class="row">
	      			     	<div class="col s3">
	      			     		<p>盈亏:</p>
	      			     	</div>
	      		     		<div class="col s9">
	      				     	<p><?=($money+$stock-$initcapital)*100/$initcapital?>%</p>
	      				    </div>
	      				</div>
	      				<br/>
	      	     	</div>
	 		     </div>
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">财报概览<i class="fa fa-ellipsis-v right"></i></span>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4"><i class="fa fa-times right"></i>温馨提示：</span>
			     <p>财报将在比赛结束后作为评定标准之一。</p>
			   </div>
			</div>
		</div>
	    <div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <img class="activator" src="/Public/res/admin-index/news.jpg">
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">最新公告<i class="fa fa-ellipsis-v right"></i></span>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">公告<i class="fa fa-times right"></i></span>
			     <p><?=html_entity_decode($announcement)?></p>
			   </div>
			</div>
		</div>
	    <div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <div id="stock" class="activator"></div>
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">股市<i class="fa fa-ellipsis-v right"></i></span>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">详情：<i class="fa fa-times right"></i></span>
			     <?php foreach ($stockVal['stocks'] as $stock){ $ratio=($stock['current']['price']-$stock['last']['price'])*100/$stock['last']['price']; ?>
			     	<p><?php echo ($stock["stock_name"]); ?> : <?=$stock['current']['time']?$stock['current']['price'].' ('.date('Y年m月d日 H:i',$stock['current']['time']).')':'暂未上市'?><span class="badge new <?=$ratio>0?'red': ($ratio==0?'grey':'green')?>"><?=round($ratio ,2)?>%</span></p>
			     <?php } ?>
			   </div>
			</div>
		</div>
		<div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <!-- <img class="activator" src="/Public/res/admin-index/question.jpg"> -->
			     <div class="activator">
			     	<br/>
			     	<div class="container">
				     	<div class="row">
					     	<div class="col s3">
					     		<lable>选择题进度:</lable>
					     	</div>
				     		<div class="col s9">
						     	<div class="progress lime lighten-4">
						     	    <div class="determinate lime" style="width: <?=100*$qp['mc']/$qp['mctot']?>%"></div>
						     	</div>
						    </div>
						</div>
			     	</div>
			     	<br/>
			     	<div class="container">
				     	<div class="row">
					     	<div class="col s3">
					     		<lable>简答题进度:</lable>
					     	</div>
				     		<div class="col s9">
						     	<div class="progress blue lighten-4">
						     	    <div class="determinate blue" style="width: <?=100*($qp['gtot']-$qp['mc'])/($qp['tot']-$qp['mctot'])?>%"></div>
						     	</div>
						    </div>
						</div>
			     	</div>
			     	<br/>
			     	<div class="container">
				     	<div class="row">
					     	<div class="col s3">
					     		<lable>总进度:</lable>
					     	</div>
				     		<div class="col s9">
						     	<div class="progress green lighten-4">
						     	    <div class="determinate green" style="width: <?=100*$qp['gtot']/$qp['tot']?>%"></div>
						     	</div>
						    </div>
						</div>
			     	</div>
	     	     	<div class="container">
	     		     	<div class="row">
	     			     	<div class="col s3">
	     			     		<p>剩余时间:</p>
	     			     	</div>
	     		     		<div class="col s9">
	     				     	<p><?=floor(($qp['deadline']-$qp['time'])/60/60/24)>=0?floor(($qp['deadline']-$qp['time'])/60/60/24):'0'?>天</p>
	     				    </div>
	     				</div>
	     	     	</div>
			     </div>
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">答题进度<i class="fa fa-ellipsis-v right"></i></span>
			     <p><a href="<?=U("test/index")?>">前往答题</a></p>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">注意：<i class="fa fa-times right"></i></span>
			     <p>请在规定时间内完成答题，否则将无法提交答案。保存即为提交，组委会不会在规定时间之间为提交的答案评分，选手可以自由修改。</p>
			   </div>
			</div>
		</div>
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
	// 	new Chartist.Pie('#question', {
	// 	  	labels: ['剩余时间'],
	// 	    series: [<?=$timeleft?>]
	// 	}, {
	// 	  donut: true,
	// 	  donutWidth: 20,
	// 	  startAngle: 270,
	// 	  total: <?=$timetotal?>,
	// 	  chartPadding: 5,
	// 	  showLabel: true,
	// 	  labelOffset: 20,
 //    	  labelDirection: 'explode',
	// 	});
	$(function(){
		new Chartist.Line('#stock', {
		  labels: [<?php for($i=1;$i<=$stockVal['count'];++$i){ echo '\''; echo $i; echo '\','; }?>],
		  series: [
		  	<?php foreach ($stockVal['stocks'] as $stock) { if(isset($stock['trend'])){?>
		    [<?php foreach ($stock['trend'] as $year) { ?> '<?=$year['price']?>', <?php  } ?>],
		    <?php } } ?>
		  ]
		}, {
		  fullWidth: true,
		  chartPadding: {
		      right: 40
		    },
		    lineSmooth: false,
		    height:440
		});
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
      $('#img').css('height',$('#img').parents('nav').height());
    });
  </script>

</body>
</html>
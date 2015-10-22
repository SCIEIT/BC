<?php if (!defined('THINK_PATH')) exit();?>
	<link rel="stylesheet" href="/Public/chartist/chartist.min.css">

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
        <li><a class="waves-effect" href="<?=U('result/index')?>">结果</a></li>
      </ul>
      
    </div>
    </nav>
</block>

	<div class="row">
	    <div class="col s12">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <div id="stock" class="activator"></div>
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">股市<i class="fa fa-arrow-up right"></i></span>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">股市<i class="fa fa-times right"></i></span>
			     <p>当前总持有量：<?=array_sum($stockheld)?></p>
			   </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <img class="activator" src="/Public/res/admin-index/news.jpg">
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">公告<i class="fa fa-arrow-up right"></i></span>
			     <br/>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">最新公告<i class="fa fa-times right"></i></span>
			     <div><?=html_entity_decode($announcement)?></div>
			   </div>
			</div>
		</div>
		<div class="col s12 m6 l3">
			<div class="card">
			   <div class="card-image waves-effect waves-block waves-light">
			     <!-- <img class="activator" src="/Public/res/admin-index/question.jpg"> -->
			     <div id="question" class="activator"></div>
			   </div>
			   <div class="card-content">
			     <span class="card-title activator grey-text text-darken-4">题目<i class="fa fa-arrow-up right"></i></span>
			     <br/>
			   </div>
			   <div class="card-reveal">
			     <span class="card-title grey-text text-darken-4">Card Title<i class="fa fa-times right"></i></span>
			     <p>Here is some more information about this product that is only revealed once clicked on.</p>
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
		$(function(){
			new Chartist.Pie('#question', {
			  	labels: ['剩余时间'],
			    series: [<?=$timeleft?>]
			}, {
			  donut: true,
			  donutWidth: 50,
			  startAngle: 270,
			  total: <?=$timetotal?>,
			  chartPadding: 50,
			  showLabel: true,
			  labelOffset: 50,
	    	  labelDirection: 'explode',
	    	  height: 350
			});
			new Chartist.Line('#stock', {
			  labels: [<?php for($i=1;$i<=$stockVal['count'];++$i){ echo '\''; echo $i; echo '\','; }?>],
			  series: [
			  	<?php foreach ($stockVal['stocks'] as $stock) { ?>
			    [<?php foreach ($stock['trend'] as $year) { ?> '<?=$year['price']?>', <?php  } ?>],
			    <?php } ?>
			  ]
			}, {
			  fullWidth: true,
			  chartPadding: {
			      right: 40
			    },
			    lineSmooth: false,
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
    });
  </script>

</body>
</html>
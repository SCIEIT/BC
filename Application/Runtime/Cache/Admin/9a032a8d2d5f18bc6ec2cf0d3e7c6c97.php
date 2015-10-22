<?php if (!defined('THINK_PATH')) exit();?>
	<link rel="stylesheet" href="/Public/chartist/chartist.min.css">

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('admin/index/index')?>" class="brand-logo">logo</a>
      
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('news/index')?>">公告</a></li>
        <li><a class="waves-effect" href="<?=U('news/instruction')?>">免责声明</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
        <li><a class="waves-effect" href="<?=U('result/index')?>">结果</a></li>
      </ul>
      
      
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="fa fa-navicon"></i><!-- <i class="material-icons">menu</i> --></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('news/index')?>">公告</a></li>
        <li><a class="waves-effect" href="<?=U('news/instruction')?>">免责声明</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
        <li><a class="waves-effect" href="<?=U('result/index')?>">结果</a></li>
      </ul>
      
    </div>
    </nav>
</block>

	<br/>
	<div class="container row">
	    <div class="col s12">
	    	<h4>各组当前的现金。</h4>
        	<div id="money"></div>
		</div>
	</div>
	<hr/>
	<br/>
	<div class="container row">
	    <div class="col s12">
	    	<h4>各组当前股票市值。</h4>
        	<div id="stock"></div>
		</div>
	</div>
	<hr/>

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
			new Chartist.Bar('#money', {
			  labels: [<?php foreach ($groupresult['cash'] as $group) { echo '\''.$group['group_name'].'\','; } ?>],
			  series: [<?php foreach ($groupresult['cash'] as $group) { echo '\''.$group['amount'].'\','; } ?>]
			}, {
			  distributeSeries: true,
			  height:450
			});
			new Chartist.Bar('#stock', {
			  labels: ['Q1', 'Q2', 'Q3', 'Q4'],
			  series: [
			    [800000, 1200000, 1400000, 1300000],
			    [200000, 400000, 500000, 300000],
			    [100000, 200000, 400000, 600000]
			  ]
			}, {
			  stackBars: true,
			  height:450
			}).on('draw', function(data) {
			  if(data.type === 'bar') {
			    data.element.attr({
			      style: 'stroke-width: 30px'
			    });
			  }
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
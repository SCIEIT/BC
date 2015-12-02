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

	<div class="container center-align">
		<table class="striped centered responsive-table center-align">
		  <thead>
		    <tr>
		    	<th>排名</th>
		    	<th>用户名</th>
		        <th>小组</th>
		        <th>成组</th>
		        <th>赛区</th>
		        <th>现金</th>
		        <th>股票</th>
		        <th><a href="<?=U('result/index',['sort'=>'asset'])?>">资产总和</a></th>
		        <th><a href="<?=U('result/index',['sort'=>'mc'])?>">选择题分数</a></th>
		        <th><a href="<?=U('result/index',['sort'=>'str'])?>">填空题分数</a></th>
		        <th><a href="<?=U('result/index',['sort'=>'tot'])?>">总分</a></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php $i=1;?>
		  	<?php foreach ($result as $group): ?>
			    <tr>
			    	<td><?=$i?></td>
			    	<td><?=$group['user_mobile']?></td>
			    	<td><?=$group['group_id']?></td>
			    	<td><?=$group['is_group']?'成组':'单人'?></td>
			    	<td><?=$group['district_id']=='1'?'深圳':'广州'?></td>
			    	<td><?=$group['money']?></td>
			    	<td><?=$group['stock']?></td>
			    	<td><?=$group['asset']?></td>
			    	<td><?=$group['mc']?></td>
			    	<td><?=$group['str']?></td>
			    	<td><?=$group['tot']?></td>
			    	<?php $i++;?>
			    </tr>
			<?php endforeach ?>
		  </tbody>
		</table>
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
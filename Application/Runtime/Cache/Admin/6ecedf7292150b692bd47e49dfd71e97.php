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

	<div class="col s10">
		<h2 class="center-align">名单上传</h2>
	</div>
	<br/>
	<h5 class="center-align">请上传</h5>
	<h6 class="center-align">Please be nice to it and don't upload trash files.</h6>
    <div class="row">
    <form class="col s12" action="<?=U('user/upload')?>" enctype="multipart/form-data" method="post" >
	    <!-- <input type="text" name="name" />
	    <input type="file" multiple name="paper[]" />
	    <input type="submit" value="提交" > -->
	        <div class="file-field input-field col s12">
		        <input type="text" name="name" class="file-path validate col s10"/>
		          <div class="btn col s2">
		            <span>File</span>
		            <input type="file" multiple name="paper[]" />
		          </div>
	        </div>
	        <h6>We are sorry but we are currently testing the stability of our server. For safty of the server, your uploads will take some time to be listed in our database.</h6>
	        <hr/>
	        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
  </button>
    </form>
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
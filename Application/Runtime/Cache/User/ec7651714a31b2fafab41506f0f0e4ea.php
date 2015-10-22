<?php if (!defined('THINK_PATH')) exit();?>

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('index/index')?>" class="brand-logo"><img id="img" src="/Public/logo.jpg"/></a>
      

      

    </div>
    </nav>
</block>

	<br/>
		<div class="container">
			<?=html_entity_decode($content['news_content'])?>
		</div>
	<br/>
	<form class="container" action="<?=U('index/instruction')?>" enctype="multipart/form-data" method="post">
		<div class="row">
		   <div class="input_field col s6">
		      <p>
		              <input type="checkbox" id="agree" name='agree'/>
		              <label for="agree">我同意以上条款</label>
		      </p>
		   </div>
		   <button class="btn waves-effect waves-light col s6" type="submit">提交
		  </button>
		  </div>
	</form>

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
      $('#img').css('height',$('#img').parents('nav').height());
    });
  </script>

</body>
</html>
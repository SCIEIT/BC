<?php if (!defined('THINK_PATH')) exit();?>

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('home/index/index')?>" class="brand-logo">logo</a>
      
      <ul id="nav-mobile" class="side-nav">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
      </ul>
      
      
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="fa fa-navicon"></i><!-- <i class="material-icons">menu</i> --></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="waves-effect" href="<?=U('index/index')?>">主页</a></li>
        <li><a class="waves-effect" href="<?=U('stock/index')?>">股票</a></li>
        <li><a class="waves-effect" href="<?=U('test/index')?>">题目</a></li>
      </ul>
      
    </div>
    </nav>
</block>

    <div class="col s10">
        <h2 class="center-align">管理员登陆</h2>
    </div>
    <br/>
    <div class="row">
        <form class="container" action="<?=U('admin/login/index')?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="input-field col s12">
              <input id="admin_id" name="admin_id" type="text" class="validate">
              <label for="admin_id">管理员ID</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="admin_password" name="admin_password" type="password" class="validate">
              <label for="admin_password">密码</label>
            </div>
          </div>
          <div class="row">
             <div class="input_field col s6">
                <p>
                        <input type="checkbox" id="remember" name='remember'/>
                        <label for="remember">记住登录</label>
                </p>
             </div>
             <button class="btn waves-effect waves-light col s6" type="submit" name="action">提交
            </button>
            </div>
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
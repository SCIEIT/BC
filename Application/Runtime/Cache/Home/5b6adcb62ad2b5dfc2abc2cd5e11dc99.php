<?php if (!defined('THINK_PATH')) exit();?>

<body style="display:none">
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?=U('home/index/index')?>" class="brand-logo">logo</a>
      

      

    </div>
    </nav>
</block>

    <div class="col s10">
        <h2 class="center-align">选手登陆</h2>
    </div>
    <br/>
    <div class="row">
        <form class="container" action="<?=U('home/login/login')?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="input-field col s12">
              <input id="user_mobile" name="user_mobile" type="text" class="validate">
              <label for="user_mobile">手机号码</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="user_password" name="user_password" type="password" class="validate">
              <label for="user_password">密码</label>
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
    By <a class="brown-text text-lighten-3" href="http://www.scieit.tk">IT Club</a>
    </div>
  </div>
</footer>
  <!--  Scripts-->

    <script type="text/javascript">
        <?php if(isset($errorMsg)){?>
            $(function(){
                Materialize.toast('<?=$errorMsg?>', 6000)
            });
        <?php }?>
    </script>

<script>
  window.onload=function(){
    $("#preloader").remove();
    $("body").show();
  }
</script>


</body>
</html>
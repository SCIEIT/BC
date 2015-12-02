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
    <div class="col s10">
      <h3 class="center-align">用户名和密码最长为11位，超过11位的部分将自动被忽略</h3>
        <h5 class="center-align">单人选手初次登陆请使用报名时登记电话作为用户名和密码 <br/>
成组报名选手们，请使用你们中一位（也就是小组组长）的电话号码作为登陆账号以及初始密码<br/>
如果是已报名的选手，请短信或致电 15880213654 寻求帮助</h5>
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
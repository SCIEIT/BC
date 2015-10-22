<?php if (!defined('THINK_PATH')) exit();?>

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

    <div class="col s10">
        <h2 class="center-align">更改密码</h2>
    </div>
    <br/>
    <div class="row">
        <form class="container" action="<?=U('user/password')?>" enctype="multipart/form-data" method="post">
          <div class="row">
            <div class="input-field col s12">
              <input id="user_password" name="user_password" type="password" class="validate">
              <label for="user_password">原密码</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="pas1" name="new_password_1" type="password" class="validate">
              <label for="pas1">新密码</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="pas2" name="new_password_2" type="password" class="validate">
              <label for="pas2">重复密码</label>
            </div>
          </div>
          <div class="row">
             <button class="btn waves-effect waves-light col s12" type="submit" name="action">提交
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

<?php if(isset($errorMsg)){?>
    <script type="text/javascript">
        
            $(function(){
                Materialize.toast('<?=$errorMsg?>', 6000)
            });
    </script>
        <?php }?>

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
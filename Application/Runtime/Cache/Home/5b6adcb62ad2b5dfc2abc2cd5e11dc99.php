<?php if (!defined('THINK_PATH')) exit();?>
	<style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>


  <body style="display:none">
    
    
    
	<div class="login-form padding20 block-shadow">
        <form action="<?=U('home/login/login')?>" enctype="multipart/form-data" method="post">
            <h1 class="text-light"><span class="mif-user"></span>选手登陆</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">用户名：</label>
                <input type="text" name="user_login" id="user_login">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">密码：</label>
                <input type="password" name="user_password" id="user_password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary"><span class="mif-paper-plane mif-ani-bounce mif-ani-slow"></span>登陆</button>
            </div>
        </form>
    </div>

    
      <footer>
      </footer>
    
    <script type="text/javascript">
      $(document).ready(function(){
        $("#preloader").remove();
        $("body").show();
      });
    </script>
    
	<script type="text/javascript">
		$(function(){
            var form = $(".login-form");
            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
	</script>

  </body>

</html>
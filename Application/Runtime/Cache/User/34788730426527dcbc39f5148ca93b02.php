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

  <h2 class="center-align">请在仔细阅读规则后答题</h2>
  <div class="container" id="escaped">
    <blockquote>
      所有选手都需要回答20道单选题<br/>
      单人选手需要回答两道案例分析题中的一道，三道论文题中的一道<br/>
      成组选手需要回答两道简答题，两道案例分析题中的一道，三道论文题中的两道
    </blockquote>
    <br/>
    <div class="container">
     <form action="<?=U('test/submit')?>" enctype="multipart/form-data" method="post">
      <div id="mc">
        <?php
 $arr=array('','A','B','C','D','E'); foreach ($MCQ as $question) { ?>
          <div class="container">
            <h5 class="blue-text"><?php echo ($question["question_content"]); ?></h5>
            <?php for($i=1;$i<=$question['choice_num'];++$i) { ?>
              <p>
                <input class="with-gap" name="<?=$question['question_id']?>" type="radio" id="<?=$question['question_id']?>_<?=$i?>" value="<?=$i?>"<?=$question['question_ans']==$i?'checked ':''?>/>
                <label for="<?=$question['question_id']?>_<?=$i?>"><?=$arr[$i]?>. <?=$question['choice_'.$i]?></label>
              </p>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
      <hr/>
      <div id="structure">
      <?php foreach ($SQ as $question) { ?>
        <div class="container">
          <blockquote><?php echo ($question["question_content"]); ?></blockquote>
          <div class="row">
            <div class="input-field col s12">
              <textarea name="<?=$question['question_id']?>" id="structure_<?=$question['question_id']?>" class="materialize-textarea"><?php echo ($question["question_ans"]); ?></textarea>
              <label for="structure_<?=$question['question_id']?>">请填写答案</label>
            </div>
          </div>
        </div>
        <br/>
        <br/>
      <?php } ?>
      </div>
      <div class="row">
       <button class="btn waves-effect waves-light col s12" type="submit" ><i class="fa fa-save"></i> 保存</button>
      </div>
     </form>
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

  <script>
    $(function(){
          document.getElementById('escaped').innerHTML=unescape(document.getElementById('escaped').innerHTML);
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
      $('#img').css('height',$('#img').parents('nav').height());
    });
  </script>

</body>
</html>
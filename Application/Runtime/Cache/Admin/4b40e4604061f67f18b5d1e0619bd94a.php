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

  <h2 class="center-align">题目批改（第<?php echo ($page); ?>页）第<?php echo ($groupid); ?>，<?=$isgroup?'成组':'单人'?></h2>
  <form class="container" action="<?=U('score/index')?>" enctype="multipart/form-data" method="get">
    <div class="row">
      <div class="input-field col s5 offset-s2">
        <input id="page" name="page" type="number" class="validate">
        <label for="page">页码（总页数：<?php echo ($count); ?>）</label>
      </div>
      <button class="btn btn-large waves-effect waves-light col s2 offset-s1" type="submit">跳转
        <i class="fa fa-save right"></i>
      </button>
    </div>
  </form>
  <div class="container" id="escaped">
  <form class="container" action="<?=U('score/index',['page'=>$page+1])?>" enctype="multipart/form-data" method="post">
    <input type="hidden" name="groupid" value="<?=$groupid?>"/>
      <ul class="collapsible popout" data-collapsible="accordion">
        <?php
 foreach ($questions as $question) { ?>
          <li>
            <div class="collapsible-header">长度：<?=strlen($question['question_ans'])?><i class="fa fa-file-word-o"></i>
            </div>
            <div class="collapsible-body">
              <blockquote><?=$question['question_content']?></blockquote>
              <hr/>
              <div class="container">
                <h6>选手作答：</h6>
                <p><?=$question['question_ans']?></p>
              </div>
              <hr/>
              <div class="input-field col s6">
                <i class="fa fa-check prefix"></i>
                <input id="<?=$question['question_id']?>" name="question[<?=$question['question_id']?>]" value="<?php
 if(empty($question['question_score'])){ if(empty($question['question_ans'])){ echo '0'; } }else{ echo $question['question_score']; } ?>" type="number" class="validate">
                <label for="<?=$question['question_id']?>">分数</label>
              </div>
            </div>
          </li>
          <?php } ?>
      </ul>
      <div class="container">
        <a class="waves-effect waves-light btn <?=$page=='1'?"disabled":""?>" href="<?=U('score/index',['page'=>$page-1])?>" >上一页</a>
        <a class="waves-effect waves-light btn <?=$pageMax?"disabled":""?>" href="<?=U('score/index',['page'=>$page+1])?>">下一页</a>
        <button class="btn waves-effect waves-light red accent-3" type="submit">保存并下一页
          <i class="fa fa-save right"></i>
        </button>
      </div>
    </form>
    <br/>
  </div>

<footer class="page-footer teal">
  
  
  <div class="footer-copyright">
    <div class="container">
    By IT Club: <a class="brown-text text-lighten-3" href="http://www.scieit.tk">www.scieit.tk</a>
    </div>
  </div>
</footer>
  <!--  Scripts-->

  <script type="text/javascript">
      document.getElementById('escaped').innerHTML=unescape(document.getElementById('escaped').innerHTML);
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
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

  <h2 class="center-align">题目列表</h2>
  <div class="container" id="escaped">
    <ul class="collapsible popout" data-collapsible="accordion" id="list">
    <?php $count=1?>
      <?php  $arr=array('','A','B','C','D','E'); foreach ($questions as $number => $question) {?> 
       <li id='<?=$question['question_id']?>'>
         <div class="collapsible-header">
          Question <?=$count?>
          <div class="right">
          <i class="fa fa-trash-o" name="deletebtn"></i>
          <i class="fa fa-pencil-square-o" name="editbtn"></i>
          </div>
         </div>
         <div class="collapsible-body">
          <blockquote><?=$question['question_content']?></blockquote>
          <input type="hidden" name="ismc" value="<?=($question['choice_num']>0);?>">
          <input type="hidden" name="ans" value="<?=$question['question_ans'];?>">
          <input type="hidden" name="group" value="<?=$question['question_group'];?>">
          <?php if($question['choice_num']>0){ ?>
          <hr/>
          <div class="container">
          <table>
            <tbody>
            <?php
 for($i=1;$i<=$question['choice_num'];++$i){?>
              <tr>
                <td <?=$i==$question['question_ans']?'class="red-text text-darken-2"':''?>><?=$arr[$i].'. '.$question['choice_'.$i];?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          </div>
          <?php }?>
         </div>
       </li>
       <?php $count++; }?>
     </ul>
     <br/>
     <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
         <button id="add" class="btn-floating btn-large blue"><i class="fa fa-plus"></i></button>
      </div>
  </div>
  <div class="container">
    <div class="row">
        <div class="col s12" id="editor">
          <div class="row">
            <div class="input-field col s12">
              <textarea id="questioncontent" class="materialize-textarea" length="500"></textarea>
              <label for="questioncontent">题目内容</label>
            </div>
          </div>
          <input type="hidden" value="" id="editid"/>
          <div class="center-align switch">
              <label>
                选择
                <input id="ismc" type="checkbox">
                <span class="lever"></span>
                填空
              </label>
          </div>
          <div id="mceditor">
              <div class="input-field col s12">
                <select id="numselector">
                  <option value="" disabled selected>请选择选项数量</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>选项数量</label>
              </div>
            <div id="choicecontainer" class="container">
            </div>
          </div>
          <div class="center-align">
          <button class="btn waves-effect waves-light" id="finish">Finish</button></div>
        </div>
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

  <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>    
  <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
  <script>
    function submitQuestion(){
      var question=new Object();
      if(""!=$('#editid').val()){
        question.question_id=$('#editid').val();
      }
      question.question_content=escape($('#questioncontent').val());
      if(!document.getElementById("ismc").checked){
        question.choice_num=$("#numselector").val();
        for(var i=1;i<=question.choice_num;++i){
          eval("question.choice_"+i+"=escape($(\"#choice_"+i+"\").val());");
        }
        question.question_ans=$("#correctans").val();
      }else{
        question.choice_num='0';
      }
      $.post("<?=U('test/update');?>",question,function(data){
          if(data==true){
            $('#editid').val("");
            Materialize.toast('更新成功', 4000);
            location.reload();
          }else{
            Materialize.toast('失败', 4000);
          }
        });
    }
    document.getElementById('escaped').innerHTML=unescape(document.getElementById('escaped').innerHTML);
    $(function(){
      $(document).ready(function() {
          $('select').material_select();
        });
      $("#editor").toggle();
      $('#questioncontent').trigger('autoresize');
      $("i[name='deletebtn']").click(function(){
        var question=$(this).parents("li[id]");
        $.get("<?=U('test/delete');?>",{
          questionid:question.attr('id')
        },function(data){
          if(data==true){
            Materialize.toast('成功删除', 4000);
            question.remove();
          }else{
            Materialize.toast('删除失败', 4000);
          }
        });
      });
      $("i[name='editbtn']").click(function(){
        Materialize.toast('开启编辑模式', 4000);
        $('#editid').val($(this).parents("li[id]").attr('id'));
        $("#editor").toggle();
      });
      $("#ismc").click(function(){
        if(this.checked){
          $("#mceditor").hide();
        }else{
          $("#mceditor").show();
        }
      });
      $("#numselector").change(function(){
        $("#choicecontainer").empty();
        $("#choicecontainer").append("<div class=\"row\"> <div class=\"input-field col s12\"> <select id=\"correctans\"> <option value=\"\" disabled selected>请选择正确答案</option> </select> </div> </div>");
        for(var i=1;i<=$(this).val();++i){
          $("#correctans").append("<option value="+i+">"+i+"</option>");
        }
        $('#correctans').material_select();
        for(var i=1;i<=$(this).val();++i){
          $("#choicecontainer").append(" <div class=\"row\"><div class=\"input-field col s12\">  <textarea id=\"choice_"+i+"\" class=\"materialize-textarea\" length=\"500\"></textarea>  <label for=\"choice_"+i+"\">选项："+i+"</label> </div></div>");
        }
      });
      $("#add").click(function(){
        $('#editid').val("");
        Materialize.toast('添加新题', 4000);
        $("#editor").toggle();
      });
      $("#finish").click(function(){
        submitQuestion();
      });
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
    });
  </script>

</body>
</html>
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

  <h2 class="center-align">题目列表</h2>
  <div class="container">
    <ul class="collapsible popout" data-collapsible="accordion">
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
          <hr/>
          <?php if($question['choice_num']>0){ ?>
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
         <a class="btn-floating btn-large green">
           <i class="fa fa-pencil"></i>
         </a>
         <ul>
           <li><button id="add" class="btn-floating blue"><i class="fa fa-plus"></i></button></li>
           <li><button id="submit" class="btn-floating lime darken-4"><i class="fa fa-paper-plane"></i></button></li>
         </ul>
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
      if(document.getElementByID('ismc').checked){

      }else{

      }
    }
    $(function(){
      $(document).ready(function() {
          $('select').material_select();
        });
      //$("#editor").toggle();
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
        $(this).parents("li[id]").attr('id');
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
        for(var i=1;i<=$(this).val();++i){
          $("#choicecontainer").append(" <div class=\"row\"><div class=\"input-field col s12\">  <textarea id=\"choice_"+i+"\" class=\"materialize-textarea\" length=\"500\"></textarea>  <label for=\"choice_"+i+"\">选项："+i+"</label> </div></div>");
        }
      });
      $("#finish").click(function(){
        submitQuestion();
        Materialize.toast('成功保存', 4000);
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
<?php
namespace Admin\Controller;
use Think\Controller;
class ResultController extends BaseController {
    public function index($sort=null){
    	$this->initialize('结果展示');
    	$this->assign('result',$this->getResult($sort));
    	$this->display();
    }
    private function getMoneyLeft($GroupID){
        return D('grouptoasset')->where(['group_id'=>$GroupID,'asset_id'=>1])->getField('amount');
    }
    public function quickSort($arr,$keyset){
       if (count($arr) == 1){
           return $arr;
       }
       $key = $arr[0];
       $left_arr = array();
       $right_arr = array();   
       for($i=1; $i < count($arr); $i++){
           if(floatval($arr[$i][$keyset]) >= floatval($key[$keyset])){
               $left_arr[] = $arr[$i];
           }else{
               $right_arr[] = $arr[$i];
           }
       }
       
       $left_arr = $this->quickSort($left_arr,$keyset);
       $right_arr = $this->quickSort($right_arr,$keyset);
       return array_merge($left_arr, $key, $right_arr);
    }
    public function sorter($arr,$key){
        for ($i = 0;$i < count($arr) - 1;$i++){
          for ($j = $i + 1;$j < count($arr);$j++){
            if ($arr[$j][$key] > $arr[$i][$key]){
              $temp = $arr[$i];
              $arr[$i] = $arr[$j];
              $arr[$j] = $temp;
            }
          }
        }
        return $arr;
    }
    private function rater($asset){
      $tmp=intval($asset/1000000);
      if($tmp==7){
        $scaled=30;
      }else if($tmp==5){
        $scaled=27;
      }else if($tmp==4){
        $scaled=25;
      }else if($asset==1000000){
        $scaled=10;
      }else if($asset>1000000){
        $scaled=intval((($asset-1000000)/2932715*15)+10);
      }else{
        $scaled=intval(10-(5*(1000000-$asset)/677285));
      }
      return $scaled;
    }
    private function getResult($sort=null){
        $groups=D('groups')->join('groupstousers on groupstousers.group_id=groups.group_id')->join('users on users.user_id=groupstousers.user_id')->join('grouptodistrict on groups.group_id=grouptodistrict.group_id')->join('grouptoasset on groups.group_id=grouptoasset.group_id and grouptoasset.asset_id=1')->where(['instruction_read'=>'1'])->order('grouptoasset.amount desc')->select();
        foreach ($groups as $key => $group) {
            $groups[$key]['stock']=$this->getGroupStock($group['group_id']);
            $groups[$key]['money']=$this->getMoneyLeft($group['group_id']);
            $groups[$key]['asset']=$this->rater($groups[$key]['stock']+$groups[$key]['money']);
            $groups[$key]['mc']=$this->checkMC($group['group_id']);
            $groups[$key]['str']=$this->getstr($group['group_id']);
            $groups[$key]['tot']=$groups[$key]['asset']+$groups[$key]['mc']+$groups[$key]['str'];
        }
        if($sort=='asset'){
            $groups=$this->sorter($groups,'asset');
        }else if($sort=='mc'){
            $groups=$this->sorter($groups,'mc');
        }else if($sort=='str'){
            $groups=$this->sorter($groups,'str');
        }else if($sort=='tot'){
            $groups=$this->sorter($groups,'tot');
        }
        return $groups;
    }
    private function checkMC($id){
        return D('questions')->join('grouptoquestion on questions.question_id=grouptoquestion.question_id and grouptoquestion.question_ans=questions.question_ans')->where('questions.choice_num>0 and grouptoquestion.group_id='.$id)->count();
    }
    private function getstr($id){
        $result=D('questions')->join('grouptoquestion on questions.question_id=grouptoquestion.question_id')->where(['questions.choice_num'=>'0','group_id'=>$id])->group('group_id')->getField('SUM(question_score)');
        if($result){
          return $result;
        }else{
          return '0';
        }
    }
    private function getStockBefore($id,$time){
        $time=D('stock_trend')->where('stock_id='.$id.' and time <='.$time)->max('time');
        return D('stock_trend')->where(['stock_id'=>$id,'time'=>$time])->find();
    }
    private function getGroupStock($id){
        $stocks=D('grouptostock')->where(['group_id'=>$id])->field('stock_id,sum(num_change)')->group('stock_id')->select();
        $sum=0;
        foreach ($stocks as $stock) {
            $sum+=((int)$stock['sum(num_change)'])*(int)($this->getStockBefore($stock['stock_id'],time())['price']);
        }
        return $sum;
    }
    public function download(){
      $data=$this->getResult();
      import("Org.Util.PHPExcel"); 
      import("Org.Util.PHPExcel.IOFactory.php");
      $PHPExcel = new \PHPExcel(); 
      $objSheet=$PHPExcel->getActiveSheet();
      $objSheet->setTitle('结果展示');
      $objSheet->setCellValue();
      $data=array_merge(array(array(
        'ID','组名','是否为小组','用户ID','','电话','密码','用户名','是否接收条款','赛区','1','金钱','股票','总资产','资产分','选择题分','简答题分','总分'
        )),$data);
      $objSheet->fromArray($data);
      $Writer=\PHPExcel_IOFactory::createWriter($PHPExcel,'Excel5');
      // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      // header('Content-Disposition: attachment;filename=\'数据.xlsx\'');
      // header('Cache-Control: max-age=0');
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
      header("Content-Type:application/force-download");
      header("Content-Type:application/vnd.ms-execl");
      header("Content-Type:application/octet-stream");
      header("Content-Type:application/download");;
      header('Content-Disposition:attachment;filename="结果.xls"');
      header("Content-Transfer-Encoding:binary");
      $Writer->save('php://output');
    }
    private function createExcel($data){ 
        // require(COMMON_PATH.'Extensions/PHPExcel.class.php');

        // $Sheet=$Excel->getSheet(0);
        // foreach ($Sheet->getRowIterator() as $row) {
        //     $arr=[];
        //     foreach ($row->getCellIterator() as $cell) {
        //         $arr[]=$cell->getValue();
        //     }
        //     preg_match("/\d{11}/", $arr[0] ,$mobile);
        //     $mobile=$mobile[0];
        //     $name=$arr[1];
        //     $is_group=$arr[2];
        //     $district=$arr[3];
        //     if(!empty($arr)&&!empty($arr[1])){
        //         if(D('users')->where(['user_mobile'=>$mobile])->count()==0){
        //             $user_id=D('users')->add(['user_mobile'=>$mobile,'user_password'=>$mobile,'user_name'=>$name,'instuction_read'=>0]);
        //             $group_id=D('groups')->add(['goup_name'=>'新小组','is_group'=>$is_group]);
        //             D('groupstousers')->add(['user_id'=>$user_id,'group_id'=>$group_id]);
        //             D('grouptoasset')->add(['group_id'=>$group_id,'asset_id'=>1,'amount'=>1000000]);
        //             D('grouptodistrict')->add(['group_id'=>$group_id,'district_id'=>$district]);
        //             echo '添加成功：'.$mobile.'<br/>';
        //             ob_flush();
        //             flush();
        //         }else{
        //             $user_id=D('users')->where(['user_mobile'=>$mobile])->getField('user_id');
        //             $group_id=D('groupstousers')->where(['user_id'=>$user_id])->getField('group_id');
        //             if(D('grouptodistrict')->where(['group_id'=>$group_id,'district_id'=>$district])->count()>0){
        //             }else{
        //                 D('grouptodistrict')->add(['group_id'=>$group_id,'district_id'=>$district]);
        //             }
        //             D('groups')->where(['group_id'=>$group_id])->save(['is_group'=>$is_group]);
        //             echo '跳过：'.$mobile.'<br/>';
        //             ob_flush();
        //             flush();
        //         }
        //     }
        // }
    }
}
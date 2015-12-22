<?php
/**
 * 以JSON格式返回
 *
 * User: JamieXu
 * Date: 15/12/22
 * Time: 下午3:17
 */
class Json extends ApiParent{

    /**
     * 以JSON格式返回数据的具体实现
     *
     * @author: JamieXu
     * @since:
     * @version: 1.0
     */
     public function response($code,$message,$data=array()){
        if(!is_numeric($code)){
            return '';
        }

         $result = array(
           'code'=>$code,
           'message'=>$message,
           'data'=>$data
         );

         echo json_encode($result);
         exit;
    }
}
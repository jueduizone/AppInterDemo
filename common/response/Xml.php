<?php
/**
 * 以XML文件格式返回
 *
 * User: JamieXu
 * Date: 15/12/22
 * Time: 下午3:17
 */
class Xml{
    /**
     * 以XML格式返回数据的具体实现
     *
     * @author: JamieXu
     * @since: 2015年12月22日15:58:29
     * @version: 1.0
     */
    public function response($code ,$message,$data=array()){
        if(!is_numeric($code)){
            return '';
        }
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        header('Content-Type:text/xml');
        $xmlStr = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xmlStr .= $this->xmlStr($result);
        echo  $xmlStr;
        exit;
    }

    public function xmlStr($result){
        $xmlStr = $attr = '';
        foreach($result as $key => $value){
            if(is_numeric($key)){
                $attr = " id='" . $key . "'";
                $key = "item";
            }
            $xmlStr .= "<{$key}{$attr}>";
            $attr='';           //防止非全部指定ID时,$attr属性被继续使用
            $xmlStr .= is_array($value) ? $this->xmlStr($value) : $value;
            $xmlStr .= "</{$key}>\n";
        }
            return $xmlStr ;
    }
}
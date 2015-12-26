<?php
/**
 * API 抽象类
 * User: JamieXu
 * Date: 15/12/22
 * Time: 下午3:22
 */
abstract class ApiParent{
    const JSON = 'Json';
    const XML = 'Xml';

    /**
     * 工厂方法
     *
     * @author: JamieXu
     * @since: 2015年12月22日15:34:07
     * @version: 1.0
     */
    public static function factory($type = self::JSON){
        $type = isset($_POST['format'])?$_POST['format']:$type;
        $resultClass=ucwords($type);
        if($resultClass==self::JSON || $resultClass==self::XML){
            require_once('../common/response/'.$type.'.php');
            return new $resultClass;
        }else{
            return false;
            exit;
        }

    }

    /**
     * 返回操作的抽象方法
     *
     * @author: JamieXu
     * @since: 2015年12月22日15:36:28
     * @version: 1.0
     */
    abstract function response($code,$message,$data);
}
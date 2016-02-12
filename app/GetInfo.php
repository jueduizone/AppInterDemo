<?php
/**
 * Created by PhpStorm.
 * User: JamieXu
 * Date: 15/12/24
 * Time: 下午1:30
 */
require_once('../common/Response.php');
require_once('../common/Db.php');
require_once('../cache/MemcacheOperate.php');
class GetInfo{
    public function returnInfo(){
        $id = $_POST['userid'];
        $format = is_null($_POST['format'])?'json':$_POST['format'];
        $db = Db::getInstance();
        try{
            $dbConn = $db->getConnect();
            $mem = new MemcacheOperate();
            $result = $mem->cacheData('info');
            //var_dump($result);
            if($result){
                return Response::getReturn('200','success',$result,$format);
            }else{
                $result = $dbConn->query("select * from t_user where id = $id");
                if($result){
                    $result = $result->fetch(PDO::FETCH_ASSOC);
                    $mem->cacheData('info',$result,200);
                    return Response::getReturn('200','success',$result,$format);
                }
                return Response::getReturn('400','fail',$result,$format);
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

$info = new GetInfo();
$info->returnInfo();
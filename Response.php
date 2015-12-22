<?php
/**
 * 请求值返回.
 * User: JamieXu
 * Date: 15/12/22
 * Time: 下午7:02
 */
require_once('ApiParent.php');
class Response {
    const JSON = 'json';

    /**
     * 请求值返回方法
     *
     * @author: JamieXu
     * @since: 2015年12月22日19:07:46
     * @version: 1.0
     */
    public static function getReturn($code, $message = '', $data = array(), $type = self::JSON){
        $factoryRes = ApiParent::factory($type);
        if(null != $factoryRes){
            $factoryRes->response($code,$message,$data);
        }else{
            var_dump(array(
                'code'=>$code,
                'message'=>$message,
                'data'=>$data
            ));
        }
    }
}

Response::getReturn(200,'Test',array(
    'aa'=>'asdasd',
    'name'=>'许银',
    'hobbit'=>array(
        'name'=>'兰奇',
        '足球'
    )
));
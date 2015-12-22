<?php
/**
 * 数据库连接类,采用单例模式
 * User: JamieXu
 * Date: 15/12/22
 * Time: 下午7:28
 */
class db{
    static private $_instance;
    static private $_connectSource;
    private $_dbConfig = array(
        'host'=>'127.0.0.1:3307',
        'user'=>'root',
        'password'=>'root',
        'database'=>'test'
    );
    /**
     * 构造方法私有化,防止进行实例化
     */
    private function __construct(){
    }

    /**
     * 对外实例化方法
     *
     * @author: JamieXu
     * @since: 2015年12月22日19:34:47
     * @version: 1.0
     */
    public function getInstance(){

    }
    //连接数据库
    public function getConnect(){


    }
}

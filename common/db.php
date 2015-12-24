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
    private $_dbms = 'mysql';
    private $_host = '127.0.0.1:3307';
    private $_user = 'root';
    private $_password = 'mysqlroot';
    private $_database = 'cnjyzEnter';

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
    public static function getInstance(){
        if(self::$_instance instanceof self){
            return self::$_instance;
        }
        return self::$_instance = new self();
    }

    //连接数据库
    public function getConnect(){
        if(!self::$_connectSource){
            try{
                self::$_connectSource = new PDO(
                    "$this->_dbms:host=$this->_host;$this->_database",
                    $this->_user,
                    $this->_password);
            }catch (PDOException $e){
                //throw new Exception('连接数据库失败!请重试!'.$e->getMessage());
                throw new Exception('啊哦,好像数据库连接出了点问题...');
            }
        }
        self::$_connectSource->query("SET NAMES UTF8");
        return self::$_connectSource;
    }
}

$db = db::getInstance();
try{
    $db->getConnect();
}catch (Exception $e){
    echo $e->getMessage();
}



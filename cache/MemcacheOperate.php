<?php

/**
 * Memcache 的操作类.
 * User: JamieXu
 * Date: 15/12/23
 * Time: 下午12:02
 */
class MemcacheOperate
{
    private $_instance;
    private $type = 'Memcached';
    private $serverArr = array(
        array('127.0.0.1', 11211)
    );

    /**
     * MemcacheOperate constructor.
     * 根据参数实例化 Memcache 或者 Memcached,然后进行连接
     * Memcached时 如果传入数组数据,没有手动序列化时(json_encode),会自动使用igbinary拓展进行序列化传入,因此需要
     * 安装igbinary拓展,否则会报错
     *
     */
    public function __construct()
    {
        if (!class_exists($this->type)) {
            return false;
        } else {
            $this->_instance = new $this->type;
            if ($this->type === 'Memcached') {
                $this->_instance->addServers($this->serverArr);
            } else {
                foreach ($this->serverArr as $value) {
                    $this->_instance->addServer($value[0], $value[1]);
                }
            }

            return $this->_instance;

        }
    }
    /**
     * 读写缓存操作,注意 Memcache, Memcached 两种拓展方式的不同
     *
     * @author: JamieXu
     * @since: 2015年12月23日14:28:30
     * @version: 1.0
     */
    public function cacheData($key, $value = '', $cacheTime = 0)
    {
        //没有值时缓存数据
        if ($value !== '') {
            //值 null 时表示删除
            if (is_null($value)) {
                return $this->_instance->delete($key);
            }
            return $this->_instance->set($key, $value, $cacheTime);
        }
        //取出缓存数据
        return $this->_instance->get($key);
    }
}

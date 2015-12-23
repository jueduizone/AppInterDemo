<?php

/**
 * Memcache 的操作类.
 * User: JamieXu
 * Date: 15/12/23
 * Time: 下午12:02
 */
class MemcacheOperate
{
    private $_host = '127.0.0.1';
    private $_port = '11211';

    /**
     * 读写缓存操作,注意 Memcache, Memcached 两种拓展方式的不同
     *
     * @author: JamieXu
     * @since: 2015年12月23日14:28:30
     * @version: 1.0
     */
    public function cacheData($key, $value = '', $cacheTime = 0)
    {
        //Memcache 拓展使用
        /**
         * $memcache = new Memcache();
         * $memcache->connect($this->_host, $this->_port);
         * echo "Memcahe start\n";
         * $memcache->set('key',"hello world => Memcahe",MEMCACHE_COMPRESSED,30);
         * echo $memcache->get('key');
         * echo "\nMemcahe end\n";
         **/

        // Memcached 拓展使用
        $memcached = new Memcached();
        $memcached->addServer($this->_host, $this->_port);

        //没有值时缓存数据
        if ($value !== '') {
            //值 null 时表示删除
            if (is_null($value)) {
                return $memcached->delete($key);
            }
            return $memcached->set($key, $value, $cacheTime);
        }
        //取出缓存数据
        echo $value = $memcached->get($key);
    }
}

$demo = new MemcacheOperate();
$demo->cacheData('age');
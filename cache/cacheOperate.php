<?php

/**
 * 本地文件 cache 操作类.
 * User: JamieXu
 * Date: 15/12/23
 * Time: 下午12:01
 */
class CacheOperate
{
    //文件路径和后缀名
    private $_dir;
    const EXT = '.txt';

    public function __construct()
    {
        $this->_dir = dirname(__FILE__) . '/cacheFiles/';
    }

    /**
     * 读写缓存操作
     *
     * @author: JamieXu
     * @since: 2015年12月23日10:28:30
     * @version: 1.0
     */
    public function cacheData($key, $value = '', $cacheTime = 0)
    {
        $filename = $this->_dir . $key . self::EXT;
        //创建缓存文件
        if ($value !== '') {
            if (is_null($value)) {
                return unlink($filename);
            }
            $dir = dirname($filename);
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            //格式化过期时间
            $cacheTime = sprintf('%011d', $cacheTime);
            //创建内容,将内容转换为字符串
            return file_put_contents($filename, $cacheTime . json_encode($value));
        }
        if (!is_file($filename)) {
            return FAlSE;
        }
        //获取文件内容和过期时间
        $contents = file_get_contents($filename);
        $cacheTime = (int)substr($contents, 0, 11);
        $value = substr($contents, 11);
        //如果文件已过期或者没有过期时间
        if ($cacheTime != 0 && (filemtime($filename) + $cacheTime) < time()) {
            unlink($filename);
            return FALSE;
        }
        //解码返回
        echo json_decode($value, true);
    }
}

//$cacheOperate = new cacheOperate();
//$cacheOperate->cacheData('test');
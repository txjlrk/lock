<?php

/**
 * @name RedisSolution
 * @package Lock\Lock
 * @desc Redis锁对象
 * @author  Ruikang <tianxingjianlrk@gmail.com>
 * @date 2020年8月20日 上午08:12:20
 * @version 1.0.0
 * 
 * @修改记录
 * <pre>
 * 版本         修改人               修改日期         修改内容描述
 * -------------------------------------------------------------------
 * 1.0.0        Ruikang              2020年8月20日    
 * -------------------------------------------------------------------
 * </pre>
 */

namespace Lock\Lock;

use Lock\LockInterface;
use Lock\LockClient;
use Lock\Lock\RedisLock;
use Lock\Client\RedisClient;
use Lock\Exception\LockException;

class RedisSolution extends LockClient
{

    /**
     * Redis Client
     */
    protected $redisClient;

    /**
     * prefix
     */
    protected $prefix;

    /**
     * @name build
     * @return Object
     */
    public function build()
    {
        $this->redisClient = RedisClient::getInstance();
        return $this;
    }

    /**
     * @name newLock
     * @desc Redis锁实例
     * @param string $lockKey 键
     * @param bool $reentrant 可重入
     * @return
     */
    public function newLock(string $lockKey, bool $reentrant = false)
    {
        return new RedisLock($this->redisClient, $this->prefix . $lockKey, $reentrant);
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = !empty($prefix) ? $prefix . ":" : "";
    }

   /**
    * @name close
    * @desc 释放锁
    */
    public function close()
    {

    }
}


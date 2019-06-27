<?php


namespace talismanfr\geocode\decorators;


use talismanfr\geocode\contracts\Geocode;
use talismanfr\kladrapi\interfaces\Kladr;
use yii\caching\CacheInterface;

class KladrCache implements Kladr
{
    /** @var Kladr  */
    private $kladr;

    /** @var \yii\caching\CacheInterface */
    private $cache;


    public $duration=null;

    public $dependency=null;

    public function __construct(Kladr $geocode,CacheInterface $cache,$duration=null,$dependency=null)
    {
        $this->kladr=$geocode;
        $this->cache=$cache;
        $this->duration=$duration;
        $this->dependency=$dependency;
    }


    /**
     * Request to kladr api with query
     * @param $query
     * @param $contentType
     * @param array $params
     * @return string
     */
    public function query($query, $contentType, $params = []): string
    {
        return $this->cache->getOrSet($query.$contentType.json_encode($params),
            function ()use($query,$contentType,$params){
                return $this->kladr->query($query,$contentType,$params);
            },$this->duration,$this->dependency
        );
    }
}
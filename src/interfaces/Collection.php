<?php


namespace talismanfr\kladrapi\interfaces;


use talismanfr\kladrapi\entity\Kladr;

interface Collection
{
    /**
     * @param $query
     * @param string $contentType
     * @param array $params
     * @return Kladr[]
     */
    public function get($query,$contentType,$params=[]):array;

    /**
     * @param $query
     * @param string $contentType
     * @param array $params
     * @return Kladr|null
     */
    public function one($query,$contentType,$params=[]):?Kladr;

}
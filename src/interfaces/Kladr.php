<?php


namespace talismanfr\kladrapi\interfaces;


interface Kladr
{
    /**
     * Request to kladr api with query
     * @param $query
     * @param $contentType
     * @param array $params
     * @return string
     */
    public function query($query, $contentType, $params = []): string;
}
<?php


namespace talismanfr\kladrapi;


use talismanfr\kladrapi\interfaces\Collection;
use talismanfr\kladrapi\entity\Kladr;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

class KladrCollection implements Collection
{
    /** @var \talismanfr\kladrapi\interfaces\Kladr */
    private $kladrApi;

    public function __construct(\talismanfr\kladrapi\interfaces\Kladr $kladrApi)
    {
        $this->kladrApi=$kladrApi;
    }

    /**
     * @param $query
     * @param $contentType
     * @return Kladr[]
     */
    public function get($query,$contentType,$params=[]): array
    {
        $response=$this->kladrApi->query($query,$contentType,$params);

        try{
            $response=json_decode($response,true);
        }catch (\Exception $e){
            \Yii::getLogger()->log('Error parse response from kladr api. '.$e->getMessage(),Logger::LEVEL_ERROR);
            return [];
        }

        return $this->mapsKladr($response);

    }

    private function mapsKladr($response):array {
        $result=ArrayHelper::getValue($response,'result');

        $return=[];

        foreach ($result as $kladrArr){
            if($kladrArr['id']=='Free'){
                continue;
            }
            $return[]=Kladr::create($kladrArr);
        }
        return $return;
    }

    /**
     * @param $query
     * @return Kladr|null
     */
    public function one($query,$contentType,$params=[]): ?Kladr
    {
        $params['limit']=1;
        $kladrs=$this->get($query,$contentType,$params);

        return ArrayHelper::getValue($kladrs,0);
    }
}
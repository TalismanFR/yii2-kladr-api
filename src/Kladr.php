<?php


namespace talismanfr\kladrapi;


use yii\helpers\ArrayHelper;

class Kladr implements \talismanfr\kladrapi\interfaces\Kladr
{
    private $domain;

    private $token;

    public function __construct(string $token, string $domain = '')
    {
        $this->token = $token;
        $this->domain = 'https://kladr-api.ru/api.php';
        if ($domain !== '') {
            $this->domain = $domain;
        }
    }

    /**
     * @param $query текст запроса
     * @param $contentType Тип контента
     * @param array $params
     * @return string as json
     */
    public function query($query, $contentType, $params = []): string
    {
        $params['query']=$query;
        $url =$this->buildUrl($contentType,$params);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt_array($curl, $this->getCurlConf());

        $response = curl_exec($curl);

        return (string)$response;
    }

    /**
     * @return resource A stream context resource.
     * @throws ProxyConfException
     */
    private function getCurlConf(): array
    {
        $conf = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_VERBOSE => false,
        ];

        return $conf;
    }

    private function buildUrl($contentType, $params = []): string
    {
        $params['contentType'] = $contentType;
        $params['token']=$this->token;
        $url = $this->domain . '?' . http_build_query($params);
        return $url;
    }


}
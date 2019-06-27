<?php
namespace decorators;

use talismanfr\geocode\decorators\KladrCache;
use talismanfr\geocode\Geocode;
use yii\caching\CacheInterface;
use yii\caching\FileCache;

class GeocodeCacheTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $geocode;

    protected function _before()
    {
        $this->geocode=new Geocode();
    }

    protected function _after()
    {
    }

    // tests
    public function testGet()
    {

        $cache=$this->makeEmpty(CacheInterface::class,['getOrSet'=>function($key, $callable, $duration = null, $dependency = null){
            $value = call_user_func($callable, $this);
            return $value;
        }]);

        $geocodeCache=new KladrCache($this->geocode,$cache);

        $result=$geocodeCache->get('Moscow');
        verify('Check first simbols',$result)->startsWith('{"response":');

    }
}
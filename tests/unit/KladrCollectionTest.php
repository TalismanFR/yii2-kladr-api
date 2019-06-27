<?php

class KladrCollectionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var \talismanfr\kladrapi\interfaces\Kladr */
    private $kladr;



    protected function _before()
    {
        $this->kladr=new \talismanfr\kladrapi\Kladr('r4BdKyEZa3syd8Dy48h82s3KstAih23T');
    }

    protected function _after()
    {
    }

    // tests
    public function testGet()
    {
        $collection=new \talismanfr\kladrapi\KladrCollection($this->kladr);

        $kladrs=$collection->get('Брянск',\talismanfr\kladrapi\entity\Kladr::TYPE_CITY);

        expect($kladrs)->notNull();

        $kladr=$kladrs[0];
        expect($kladr)->isInstanceOf(\talismanfr\kladrapi\entity\Kladr::class);
    }

    public function testOne(){
        $collection=new \talismanfr\kladrapi\KladrCollection($this->kladr);

        $kladr=$collection->one('Брянск',\talismanfr\kladrapi\entity\Kladr::TYPE_CITY);

        expect($kladr)->isInstanceOf(\talismanfr\kladrapi\entity\Kladr::class);

        expect($kladr->getName())->equals('Брянск');
    }
}

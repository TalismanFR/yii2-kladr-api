<?php

class KladrTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testQuery()
    {
        $kladr=new \talismanfr\kladrapi\Kladr('r4BdKyEZa3syd8Dy48h82s3KstAih23T');

        $response=$kladr->query('Брянск','city');

        expect($response)->notEmpty();
        expect($response)->startsWith('{"searchContext":{"contentType":"city",');
    }
}
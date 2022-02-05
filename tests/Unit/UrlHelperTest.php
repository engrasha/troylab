<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\UrlHelper;

class UrlHelperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    public function testExtractLinksFromString()
    {
        $urlHelper = new UrlHelper();

        // UseCase-1: our function should return blank array when blank string is given
        $this->assertEmpty($urlHelper->extractLinksFromString(''));
    }
    
}

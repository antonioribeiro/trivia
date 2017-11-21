<?php

namespace PragmaRX\Random;

use PragmaRX\Trivia\Trivia;

class TriviaTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->trivia = new Trivia();
    }

    public function testGetAll()
    {
        $this->assertTrue($this->trivia->all()->count() > 41000);
    }
}

function dd($a)
{
    var_dump($a);
    die;
}

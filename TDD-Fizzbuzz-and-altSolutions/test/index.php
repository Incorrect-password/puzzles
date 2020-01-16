<?php
Use PHPUnit\Framework\TestCase;

require('../index.php');

class indexTest extends TestCase
{
    public function testFizzBuzzLength()
    {
        $this->assertEquals(count(fizzBuzz()),100);
    }

    public function testFizzBuzzOneToOneHundred()
    {
        $expected[0] = 1;
        $expected[96] = 97;
        $result = fizzBuzz();
        $this->assertEquals($expected[0], $result[0]);
        $this->assertEquals($expected[96],$result[96]);
    }

    public function testFizzBuzzMultiple3()
    {
        $expected[2] = 'fizz';
        $expected[65] = 'fizz';
        $expected[32] = 'fizz';
        $result = fizzBuzz();
        $this->assertEquals($expected[2], $result[2]);
        $this->assertEquals($expected[65], $result[65]);
        $this->assertEquals($expected[32], $result[32]);
    }

    public function testFizzBuzzMultiple5()
    {
        $expected[4] = 'buzz';
        $expected[64] = 'buzz';
        $expected[99] = 'buzz';
        $result = fizzBuzz();
        $this->assertEquals($expected[4], $result[4]);
        $this->assertEquals($expected[64], $result[64]);
        $this->assertEquals($expected[99], $result[99]);
    }

    public function testFizzBuzzMultiple3And5()
    {
        $expected[14] = 'fizzbuzz';
        $expected[44] = 'fizzbuzz';
        $expected[89] = 'fizzbuzz';
        $result = fizzBuzz();
        $this->assertEquals($expected[14], $result[14]);
        $this->assertEquals($expected[44], $result[44]);
        $this->assertEquals($expected[89], $result[89]);
    }
}
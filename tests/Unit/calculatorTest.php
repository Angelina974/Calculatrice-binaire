<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../src/functions.php';

class CalculatorTest extends TestCase
{
   /**
     * Test valide : addition binaire 10₂ + 1₂ = 11₂
     */
    public function testAddition()
    {
        $this->assertEquals(
            '11',
            calculateBinary('10', '1', 'add'),
            '2₂ + 1₂ doit donner 11₂'
        );
    }

    /**
     * Test volontairement conçu pour échouer
     */
    public function testInvalidBinaryInput(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        calculateBinary('10a', '101', 'add');
    }

    public function testUnknownOperation(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        calculateBinary('10', '1', 'foo');
    }
    
    /**
     * Test additionnel : soustraction 101₂ - 1₂ = 100₂
     */
    public function testSubtraction()
    {
        $this->assertEquals(
            '100',
            calculateBinary('101', '1', 'sub'),
            '5₂ - 1₂ doit donner 100₂'
        );
    }

    
}
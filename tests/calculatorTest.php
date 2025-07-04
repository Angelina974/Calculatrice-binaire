<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/functions.php';

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
     * Test volontairement conçu pour échouer :
     * on s'attend à 100₂ alors que l'opération renvoie 11₂
     */
    public function testIntentionalFailure()
    {
        $this->assertEquals(
            '100',
            calculateBinary('10', '1', 'add')
        
        );
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

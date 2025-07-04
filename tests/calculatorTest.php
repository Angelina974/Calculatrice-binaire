<?php
use PHPUnit\Framework\TestCase;

// Inclure votre code (ou mieux : autoload via composer)
require_once __DIR__ . '/../index.php';

class CalculatorTest extends TestCase
{
    public function testIsBinaryValid()
    {
        $this->assertTrue(isBinary('101010'));
        $this->assertFalse(isBinary('102010'));
        $this->assertFalse(isBinary(''));
    }

    public function testAddition()
    {
        $_POST = ['a_bin'=>'1010','b_bin'=>'0011','operation'=>'add'];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        ob_start();
        include __DIR__ . '/../index.php';
        ob_end_clean();

        // On sait 10₂ + 3₂ = 13₂ = 1101
        $this->assertStringContainsString('1101', $GLOBALS['result']);
    }

    public function testDivisionByZero()
    {
        $_POST = ['a_bin'=>'1010','b_bin'=>'0000','operation'=>'div'];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        ob_start();
        include __DIR__ . '/../index.php';
        ob_end_clean();

        $this->assertStringContainsString('Division par zéro impossible', $GLOBALS['error']);
    }

    // Ajoutez autant de tests (sub, mul, and/or/xor) que nécessaire…
}

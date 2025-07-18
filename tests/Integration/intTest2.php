<?php
use PHPUnit\Framework\TestCase;

class CalculatorIntegrationTest extends TestCase
{
    public function testIntegrationErrorDisplayed(): void
    {
        // Simule un POST invalide
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['a_bin'=>'abc', 'b_bin'=>'1', 'operation'=>'add'];

        ob_start();
        require __DIR__ . '/../../index.php';
        $html = ob_get_clean();

        $this->assertStringContainsString('Veuillez entrer deux nombres binaires valides', $html);
    }

    public function testIntegrationSuccessDisplayed(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['a_bin'=>'101', 'b_bin'=>'1', 'operation'=>'sub'];

        ob_start();
        require __DIR__ . '/../../index.php';
        $html = ob_get_clean();

        $this->assertStringContainsString('Résultat (binaire) : 100', $html);
    }

    public function testGetDisplaysForm(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        ob_start();
        require $this->indexPath;
        $html = ob_get_clean();

        // On doit voir le formulaire et les champs vides
        $this->assertStringContainsString('<form', $html);
        $this->assertStringContainsString('name="a_bin"', $html);
        $this->assertStringContainsString('value=""', $html);
    }

}

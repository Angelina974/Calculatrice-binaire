<?php
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * Chemin vers le fichier index.php de l'application
     */
    private string $indexFile;

    protected function setUp(): void
    {
        $this->indexFile = __DIR__ . '/../index.php';
    }

    /**
     * Vérifie que le formulaire s'affiche en GET
     */
    public function testDisplaysForm(): void
    {
        // Simule une requête GET
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_POST = [];

        ob_start();
        require $this->indexFile;
        $output = ob_get_clean();

        $this->assertStringContainsString('<form', $output, 'Le formulaire devrait être présent');
        $this->assertStringContainsString('name="a_bin"', $output, 'Le champ a_bin devrait être présent');
    }

    /**
     * Test d'intégration de l'addition 10₂ + 1₂ = 11₂
     */
    public function testAdditionIntegration(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'a_bin'     => '10',
            'b_bin'     => '1',
            'operation' => 'add',
        ];

        ob_start();
        require $this->indexFile;
        $output = ob_get_clean();

        $this->assertStringContainsString('Résultat (binaire) : 11', $output);
    }

    /**
     * Test d'intégration de la soustraction 101₂ - 1₂ = 100₂
     */
    public function testSubtractionIntegration(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'a_bin'     => '101',
            'b_bin'     => '1',
            'operation' => 'sub',
        ];

        ob_start();
        require $this->indexFile;
        $output = ob_get_clean();

        $this->assertStringContainsString('Résultat (binaire) : 100', $output);
    }
}

<?php
use PHPUnit\Framework\TestCase;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class EndToEndTest extends TestCase
{
    private HttpBrowser $client;

    protected function setUp(): void
    {
        // Crée un client HTTP Symfony pointant vers ton serveur local
        $this->client = new HttpBrowser(HttpClient::create([
            'base_uri' => 'http://localhost:8000'
        ]));
    }

    /** Vérifie que la page affiche bien le formulaire en GET */
    public function testHomepageDisplaysForm(): void
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('form')->count());
        $this->assertGreaterThan(0, $crawler->filter('input[name="a_bin"]')->count());
    }

    /** Test end-to-end de l’addition binaire via POST */
    public function testAdditionEndToEnd(): void
    {
        $crawler = $this->client->request('POST', '/', [
            'body' => [
                'a_bin'     => '10',
                'b_bin'     => '1',
                'operation' => 'add',
            ]
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertStringContainsString(
            'Résultat (binaire) : 11',
            $this->client->getResponse()->getContent()
        );
    }
}

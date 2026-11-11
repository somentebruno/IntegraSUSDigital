<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class PortalRoutesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('IntegraSUS');
        $response->assertSee('Mato Grosso');
    }

    public function test_about_page_is_accessible(): void
    {
        $response = $this->get('/quem-somos');
        $response->assertStatus(200);
        $response->assertSee('Quem Somos');
        $response->assertSee('Resolução CIB/MT nº 830/2023');
        $response->assertSee('Lei Estadual MT nº 12.389/2024');
    }

    public function test_services_page_is_accessible(): void
    {
        $response = $this->get('/servicos');
        $response->assertStatus(200);
        $response->assertSee('Teleconsultoria');
        $response->assertSee('Tele-Raio-X');
        $response->assertSee('Tele-retinografia');
        $response->assertSee('Tele-estomatologia');
        $response->assertSee('Tele-ECG');
        $response->assertSee('Tele-Educação');
    }

    public function test_service_detail_page_is_accessible(): void
    {
        $response = $this->get('/servicos/tele-retinografia');
        $response->assertStatus(200);
        $response->assertSee('Tele-retinografia');
        $response->assertSee('retina');
    }

    public function test_posts_page_is_accessible(): void
    {
        $response = $this->get('/noticias');
        $response->assertStatus(200);
        $response->assertSee('Notícias e Ações');
    }

    public function test_post_detail_page_is_accessible(): void
    {
        $response = $this->get('/noticias/saude-digital-mt-supera-marca-10-mil-teleconsultorias');
        $response->assertStatus(200);
        $response->assertSee('Saúde Digital MT supera marca de 10 mil teleconsultorias');
    }

    public function test_gallery_page_is_accessible(): void
    {
        $response = $this->get('/galeria');
        $response->assertStatus(200);
        $response->assertSee('Galeria de Ações nos Municípios');
    }

    public function test_contact_page_is_accessible(): void
    {
        $response = $this->get('/contato');
        $response->assertStatus(200);
        $response->assertSee('Suporte Técnico');
        $response->assertSee('saudedigitalmt@ses.mt.gov.br');
        $response->assertSee('3622-3660');
    }

    public function test_admin_login_is_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }
}

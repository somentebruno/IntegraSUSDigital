<?php

namespace Tests\Feature;

use App\Livewire\BlogList;
use App\Livewire\PhotoGallery;
use Database\Seeders\DatabaseSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class BlogAndGalleryLivewireTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_blog_list_filters_by_search(): void
    {
        Livewire::test(BlogList::class)
            ->set('search', '10 mil teleconsultorias')
            ->assertSee('Saúde Digital MT supera marca de 10 mil teleconsultorias')
            ->set('search', 'termo_inexistente_123')
            ->assertSee('Nenhuma publicação encontrada');
    }

    public function test_photo_gallery_can_set_category_and_interact(): void
    {
        Livewire::test(PhotoGallery::class)
            ->assertSee('Oficina Regional de Telessaúde')
            ->call('setCategory', 'Eventos')
            ->assertSet('activeCategory', 'Eventos')
            ->assertSee('Encontro de Integração dos 16 Escritórios Regionais');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\GalleryAlbum;
use App\Models\Indicator;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Página Inicial do Portal IntegraSUS Digital MT
     */
    public function index()
    {
        $banners = Banner::active()->get();
        $indicators = Indicator::active()->get();
        $services = Service::active()->get();
        $latestPosts = Post::with('category')->published()->take(3)->get();
        $galleryPreview = GalleryAlbum::with('photos')->active()->take(3)->get();

        return view('portal.index', compact(
            'banners',
            'indicators',
            'services',
            'latestPosts',
            'galleryPreview'
        ));
    }

    /**
     * Página Quem Somos - Estrutura Institucional e Normativa
     */
    public function about()
    {
        return view('portal.about');
    }

    /**
     * Página Geral de Serviços de Telessaúde
     */
    public function services()
    {
        $services = Service::active()->get();
        return view('portal.services', compact('services'));
    }

    /**
     * Detalhe de um Serviço Individual
     */
    public function serviceDetail(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->where('is_active', true)->get();

        return view('portal.service-detail', compact('service', 'otherServices'));
    }

    /**
     * Página de Notícias e Comunicação
     */
    public function posts()
    {
        return view('portal.posts');
    }

    /**
     * Leitura de Postagem Individual (Single Post)
     */
    public function postDetail(string $slug)
    {
        $post = Post::with('category')->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->published()
            ->take(3)
            ->get();

        return view('portal.post-detail', compact('post', 'relatedPosts'));
    }

    /**
     * Galeria de Fotos e Ações nos Municípios
     */
    public function gallery()
    {
        return view('portal.gallery');
    }

    /**
     * Mapa Interativo de Cobertura e Adesão dos Municípios (API IBGE)
     */
    public function coverageMap()
    {
        return view('portal.map');
    }

    /**
     * Contato, Transparência e Suporte
     */
    public function contact()
    {
        return view('portal.contact');
    }
}

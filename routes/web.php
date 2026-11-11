<?php

use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas do Portal IntegraSUS Digital Mato Grosso
Route::get('/', [PortalController::class, 'index'])->name('portal.index');
Route::get('/quem-somos', [PortalController::class, 'about'])->name('portal.about');
Route::get('/servicos', [PortalController::class, 'services'])->name('portal.services');
Route::get('/servicos/{slug}', [PortalController::class, 'serviceDetail'])->name('services.show');
Route::get('/noticias', [PortalController::class, 'posts'])->name('portal.posts');
Route::get('/noticias/{slug}', [PortalController::class, 'postDetail'])->name('posts.show');
Route::get('/galeria', [PortalController::class, 'gallery'])->name('portal.gallery');
Route::get('/mapa-cobertura', [PortalController::class, 'coverageMap'])->name('portal.map');
Route::get('/contato', [PortalController::class, 'contact'])->name('portal.contact');

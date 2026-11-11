<?php

namespace App\Livewire;

use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use Livewire\Component;

class PhotoGallery extends Component
{
    public string $activeCategory = 'Todas';
    public bool $isModalOpen = false;
    public ?array $activePhotoData = null;

    public function setCategory(string $category)
    {
        $this->activeCategory = $category;
    }

    public function openLightbox(int $photoId)
    {
        $photo = GalleryPhoto::with('album')->find($photoId);
        if ($photo) {
            $this->activePhotoData = [
                'id' => $photo->id,
                'image_path' => $photo->image_path,
                'caption' => $photo->caption ?? $photo->album?->title,
                'album_title' => $photo->album?->title,
                'event_date' => $photo->album?->event_date?->format('d/m/Y'),
                'category' => $photo->album?->category,
            ];
            $this->isModalOpen = true;
        }
    }

    public function closeLightbox()
    {
        $this->isModalOpen = false;
        $this->activePhotoData = null;
    }

    public function render()
    {
        $query = GalleryAlbum::with('photos')->active();

        if ($this->activeCategory !== 'Todas') {
            $query->where('category', $this->activeCategory);
        }

        $albums = $query->get();

        return view('livewire.photo-gallery', [
            'albums' => $albums,
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $selectedCategory = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function selectCategory(string $slug)
    {
        $this->selectedCategory = ($this->selectedCategory === $slug) ? '' : $slug;
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::withCount('posts')->get();

        $postsQuery = Post::query()
            ->with('category')
            ->published();

        if (!empty($this->search)) {
            $postsQuery->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->selectedCategory)) {
            $postsQuery->whereHas('category', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }

        $posts = $postsQuery->paginate(6);

        return view('livewire.blog-list', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}

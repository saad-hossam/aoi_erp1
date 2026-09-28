<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class PageService
{
    public function getAllPages(): Collection
    {
        return Page::query()
            ->orderBy('id')
            ->get();
    }

    public function getPage(int $id): ?Page
    {
        return Page::find($id);
    }

    public function getPageBySlug(string $slug): ?Page
    {
        return Page::where('slug', $slug)->first();
    }

    public function getActivePages(): Collection
    {
        return Page::where('status', 'active')
            ->orderBy('name')
            ->get();
    }

    public function createPage(array $data): Page
    {
        return Page::create($data);
    }

    public function updatePage(Page $page, array $data): bool
    {
        return $page->update($data);
    }

    public function deletePage(Page $page): bool
    {
        return $page->delete();
    }
    public function getPageByRoutePath(string $path): ?Page
{
    return Page::where('route_path', $path)
        ->where('status', 'active')
        ->first();
}
}
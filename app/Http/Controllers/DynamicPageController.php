<?php

namespace App\Http\Controllers;

use App\Services\PageService;

class DynamicPageController extends Controller
{
    public function __construct(
        private PageService $pageService
    ) {
    }

    public function show(string $path)
    {
        $page = $this->pageService->getPageByRoutePath($path);

        abort_if(!$page, 404);

        if ($page->status !== 'active') {
            abort(404);
        }

        abort_unless(
            $page->component && view()->exists($page->component),
            404
        );

        return view(
            $page->component,
            compact('page')
        );
    }
}
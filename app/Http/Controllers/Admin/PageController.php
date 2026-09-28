<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function __construct(
        private PageService $pageService
    ) {
    }

    public function index()
    {
        $pages = $this->pageService->getAllPages();

        return view(
            'dashboard.pages.index',
            compact('pages')
        );
    }

    public function create()
    {
        return view('dashboard.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:erp_pages,slug',
            ],

            'type' => [
                'required',
                'string',
                'max:255',
            ],

            'component' => [
                'nullable',
                'string',
                'max:255',
            ],

            'controller' => [
                'nullable',
                'string',
                'max:255',
            ],

            'route_name' => [
                'required',
                'string',
                'max:255',
                'unique:erp_pages,route_name',
            ],

            'route_path' => [
                'required',
                'string',
                'max:255',
                'unique:erp_pages,route_path',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $this->pageService->createPage($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with(
                'success',
                'Page created successfully.'
            );
    }

    public function show(int $id)
    {
        $page = $this->pageService->getPage($id);

        abort_if(!$page, 404);

        return view(
            'dashboard.pages.show',
            compact('page')
        );
    }

    public function edit(int $id)
    {
        $page = $this->pageService->getPage($id);

        abort_if(!$page, 404);

        return view(
            'dashboard.pages.edit',
            compact('page')
        );
    }

    public function update(Request $request, int $id)
    {
        $page = $this->pageService->getPage($id);

        abort_if(!$page, 404);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('erp_pages', 'slug')
                    ->ignore($page->id),
            ],

            'type' => [
                'required',
                'string',
                'max:255',
            ],

            'component' => [
                'nullable',
                'string',
                'max:255',
            ],

            'controller' => [
                'nullable',
                'string',
                'max:255',
            ],

            'route_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('erp_pages', 'route_name')
                    ->ignore($page->id),
            ],

            'route_path' => [
                'required',
                'string',
                'max:255',
                Rule::unique('erp_pages', 'route_path')
                    ->ignore($page->id),
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $this->pageService->updatePage(
            $page,
            $validated
        );

        return redirect()
            ->route('admin.pages.index')
            ->with(
                'success',
                'Page updated successfully.'
            );
    }

    public function destroy(int $id)
    {
        $page = $this->pageService->getPage($id);

        abort_if(!$page, 404);

        $this->pageService->deletePage($page);

        return redirect()
            ->route('admin.pages.index')
            ->with(
                'success',
                'Page deleted successfully.'
            );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PageService;
use App\Services\TreePageMappingService;
use App\Services\TreeService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TreePageMappingController extends Controller
{
    public function __construct(
        private TreePageMappingService $mappingService,
        private TreeService $treeService,
        private PageService $pageService
    ) {
    }

    public function index()
    {
        $mappings = $this->mappingService->getAllMappings();

        $nodes = $this->treeService->getAllNodes();

        return view(
            'dashboard.tree_page_mappings.index',
            compact('mappings', 'nodes')
        );
    }

    public function create()
    {
        $nodes = $this->treeService
            ->getAllNodes()
            ->sortBy('value')
            ->values();

        $pages = $this->pageService->getActivePages();

        return view(
            'dashboard.tree_page_mappings.create',
            compact('nodes', 'pages')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tree_value' => [
                'required',
                'integer',
                Rule::exists('oracle.ERP_SYSTEM_TREE', 'VALUE'),
                Rule::unique('oracle.ERP_TREE_PAGE_MAPPINGS', 'tree_value'),
            ],

            'page_id' => [
                'required',
                'integer',
                Rule::exists('oracle.ERP_PAGES', 'id'),
            ],
        ]);

        $this->mappingService->createMapping($validated);

        return redirect()
            ->route('admin.tree-page-mappings.index')
            ->with('success', 'Tree node mapped to page successfully.');
    }

    public function show(int $id)
    {
        $mapping = $this->mappingService->getMapping($id);

        abort_if(!$mapping, 404);

        $node = $this->treeService->getNode(
            (string) $mapping->tree_value
        );

        return view(
            'dashboard.tree_page_mappings.show',
            compact('mapping', 'node')
        );
    }

    public function edit(int $id)
    {
        $mapping = $this->mappingService->getMapping($id);

        abort_if(!$mapping, 404);

        $nodes = $this->treeService
            ->getAllNodes()
            ->sortBy('value')
            ->values();

        $pages = $this->pageService->getActivePages();

        return view(
            'dashboard.tree_page_mappings.edit',
            compact('mapping', 'nodes', 'pages')
        );
    }

    public function update(Request $request, int $id)
    {
        $mapping = $this->mappingService->getMapping($id);

        abort_if(!$mapping, 404);

        $validated = $request->validate([
            'tree_value' => [
                'required',
                'integer',
                Rule::exists('oracle.ERP_SYSTEM_TREE', 'VALUE'),
                Rule::unique('oracle.ERP_TREE_PAGE_MAPPINGS', 'tree_value')
                    ->ignore($mapping->id),
            ],

            'page_id' => [
                'required',
                'integer',
                Rule::exists('oracle.ERP_PAGES', 'id'),
            ],
        ]);

        $this->mappingService->updateMapping(
            $mapping,
            $validated
        );

        return redirect()
            ->route('admin.tree-page-mappings.index')
            ->with('success', 'Mapping updated successfully.');
    }

    public function destroy(int $id)
    {
        $mapping = $this->mappingService->getMapping($id);

        abort_if(!$mapping, 404);

        $this->mappingService->deleteMapping($mapping);

        return redirect()
            ->route('admin.tree-page-mappings.index')
            ->with('success', 'Mapping deleted successfully.');
    }
}
<?php

namespace App\Services;

use App\Models\TreeNode;
use App\Models\TreePageMapping;

class NavigationService
{
    public function __construct(
        private TreeService $treeService
    ) {
    }

    private function buildNode(TreeNode $node): array
    {
        $children = $this->treeService
            ->getChildrenMap()
            ->get((string) $node->value, collect())
            ->sortBy('value')
            ->values();

        $mapping = TreePageMapping::query()
            ->with('page')
            ->where('tree_value', $node->value)
            ->first();

        return [
            'node' => $node,
            'page' => $mapping?->page,
            'children' => $children
                ->map(fn (TreeNode $child) => $this->buildNode($child))
                ->values()
                ->all(),
        ];
    }

    public function getNavigation(): array
    {
        $root = $this->treeService->getRoot();

        if (!$root) {
            return [];
        }

        return [
            'root' => $root,
            'children' => $this->treeService
                ->getChildren($root->value)
                ->sortBy('value')
                ->map(fn (TreeNode $node) => $this->buildNode($node))
                ->values()
                ->all(),
        ];
    }
}
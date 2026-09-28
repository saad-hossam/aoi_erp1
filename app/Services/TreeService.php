<?php

namespace App\Services;

use App\Models\TreeNode;
use Illuminate\Support\Collection;

class TreeService
{
    private ?Collection $nodes = null;

    private ?Collection $childrenMap = null;

    private function loadNodes(): Collection
    {
        if ($this->nodes === null) {
            $this->nodes = TreeNode::query()->get();
        }

        return $this->nodes;
    }

    public function getAllNodes(): Collection
    {
        return $this->loadNodes();
    }

    public function getNode(string $value): ?TreeNode
    {
        return $this->loadNodes()->first(
            fn ($node) =>
                (string) $node->value === (string) $value
        );
    }

    public function getChildren($parentValue): Collection
    {
        return $this->loadNodes()
            ->filter(
                fn ($node) =>
                    (string) $node->parent_value === (string) $parentValue
            )
            ->values();
    }

    public function getParent($value): ?TreeNode
    {
        $node = $this->getNode((string) $value);

        if (!$node || $node->parent_value === null) {
            return null;
        }

        return $this->getNode((string) $node->parent_value);
    }

    public function getRoot(): ?TreeNode
    {
        return $this->loadNodes()->first(
            fn ($node) => $node->parent_value === null
        );
    }

    public function getChildrenMap(): Collection
    {
        if ($this->childrenMap === null) {
            $this->childrenMap = $this->loadNodes()
                ->groupBy(
                    fn ($node) => (string) $node->parent_value
                );
        }

        return $this->childrenMap;
    }

    public function refresh(): void
    {
        $this->nodes = null;
        $this->childrenMap = null;
    }
}
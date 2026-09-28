<?php

namespace App\Services;

use App\Models\TreePageMapping;
use Illuminate\Database\Eloquent\Collection;

class TreePageMappingService
{
    public function getAllMappings(): Collection
    {
        return TreePageMapping::query()
            ->with('page')
            ->orderBy('id')
            ->get();
    }

    public function getMapping(int $id): ?TreePageMapping
    {
        return TreePageMapping::with('page')->find($id);
    }

    public function getMappingByTreeValue(int $treeValue): ?TreePageMapping
    {
        return TreePageMapping::with('page')
            ->where('tree_value', $treeValue)
            ->first();
    }

    public function createMapping(array $data): TreePageMapping
    {
        return TreePageMapping::create($data);
    }

    public function updateMapping(
        TreePageMapping $mapping,
        array $data
    ): bool {
        return $mapping->update($data);
    }

    public function deleteMapping(TreePageMapping $mapping): bool
    {
        return $mapping->delete();
    }
}
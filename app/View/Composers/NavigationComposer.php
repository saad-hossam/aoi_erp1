<?php

namespace App\View\Composers;

use App\Services\NavigationService;
use Illuminate\View\View;

class NavigationComposer
{
    public function __construct(
        private NavigationService $navigationService
    ) {
    }

    public function compose(View $view): void
    {
        $navigation = $this->navigationService->getNavigation();

        $view->with('navigation', $navigation);
    }
}
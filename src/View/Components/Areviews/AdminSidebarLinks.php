<?php

namespace Takshak\Areviews\View\Components\Areviews;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class AdminSidebarLinks extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return View::first([
            'components.areviews.admin-sidebar-links',
            'areviews::components.areviews.admin-sidebar-links'
        ]);
    }
}

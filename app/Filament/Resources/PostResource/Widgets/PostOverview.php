<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\Widget;

class PostOverview extends Widget
{
    protected int | string | array $columnSpan = 3;

    protected static string $view = 'filament.widgets.post-overview';
}

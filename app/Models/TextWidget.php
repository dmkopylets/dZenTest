<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TextWidget extends Model
{
    protected $table = 'text_widgets';
    protected $fillable = [
        'key',
        'image',
        'title',
        'content',
        'active',
    ];

    public static function getTitle(string $key): string
    {
        $widget = Cache::get('text-widget-title-' . $key, function () use ($key) {
            return TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });
        if ($widget) {
            return $widget->title;
        }

        return '';
    }

    public static function getContent(string $key): string
    {
        $widget = Cache::get('text-widget-title-' . $key, function () use ($key) {
            return TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });
        if ($widget) {
            return $widget->content;
        }

        return '';
    }
}

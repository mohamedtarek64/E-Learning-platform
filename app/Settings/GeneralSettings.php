<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public ?string $site_logo;
    public string $timezone;
    public string $date_format;
    public int $items_per_page;
    public ?string $facebook_url;
    public ?string $twitter_url;
    public ?string $instagram_url;
    public bool $maintenance_mode;

    public static function group(): string
    {
        return 'general';
    }
}
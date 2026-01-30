<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'E-Learning Platform');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.timezone', 'UTC');
        $this->migrator->add('general.date_format', 'Y-m-d');
        $this->migrator->add('general.items_per_page', 10);
        $this->migrator->add('general.facebook_url', '');
        $this->migrator->add('general.twitter_url', '');
        $this->migrator->add('general.instagram_url', '');
        $this->migrator->add('general.maintenance_mode', false);
    }
};

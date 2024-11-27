<?php

namespace Capitaine;

class ThemeJsonLoader
{
    public function execute(): void
    {
        $this->registerHooks();
    }

    public function registerHooks(): void
    {
        add_filter('wp_theme_json_data_theme', [$this, 'assembleFiles']);
    }

    public function assembleFiles($theme_json): mixed
    {
        # Charger les JSON secondaires
        $theme_styles_raw = file_get_contents(get_template_directory() . '/theme-styles.json');
        $theme_settings_raw = file_get_contents(get_template_directory() . '/theme-settings.json');

        # Convertir le JSON en tableau
        $theme_styles = json_decode($theme_styles_raw, true);
        $theme_settings = json_decode($theme_settings_raw, true);

        # Injecter les données
        $new_data = [
            'version' => 3,
            'styles' => $theme_styles,
            'settings' => $theme_settings,
        ];

        # Mettre à jour le theme.json de WordPress
        return $theme_json->update_with($new_data);
    }
}

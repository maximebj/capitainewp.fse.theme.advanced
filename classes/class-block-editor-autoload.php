<?php

namespace Capitaine;

class BlockEditorAutoload
{
    public function registerHooks(): void
    {
        add_action('init', [$this, 'registerCustomBlocks']);
        add_action('init', [$this, 'registerBlocksAssets']);
        add_filter('wp_theme_json_data_theme', [$this, 'composeThemeJson']);
    }

    # Déclarer automatiquement les blocs sur-mesure du dossier /blocks/ 
    public function registerCustomBlocks(): void
    {
        $folders = glob(get_template_directory() . '/blocks/*/');

        foreach ($folders as $folder) {
            $block = basename($folder);
            register_block_type(dirname(__DIR__) . "/blocks/$block");
        }
    }

    # Charger automatiquement les styles de blocs du dossier /assets/css/
    public function registerBlocksAssets(): void
    {
        $files = glob(get_template_directory() . '/assets/css/*.css');

        foreach ($files as $file) {
            $filename   = basename($file, '.css');
            $block_name = str_replace('core-', 'core/', $filename);

            wp_enqueue_block_style(
                $block_name,
                [
                    'handle' => "capitaine-{$filename}",
                    'src'    => get_theme_file_uri("assets/css/{$filename}.css"),
                    'path'   => get_theme_file_path("assets/css/{$filename}.css"),
                    'ver'    => filemtime(get_theme_file_path("assets/css/{$filename}.css")),
                ]
            );
        }
    }

    # Recomposer le theme.json à partir des fichiers intermédiaires
    public function composeThemeJson($theme_json): mixed
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

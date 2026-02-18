<?php

namespace Capitaine;

# Inclure les fichiers
require_once __DIR__ . '/classes/class-binding.php';
require_once __DIR__ . '/classes/class-theme-setup.php';
require_once __DIR__ . '/classes/class-block-editor-autoload.php';
require_once __DIR__ . '/classes/class-json-config.php';


# Initialiser les classes
(new Binding)->registerHooks();
(new BlockEditorAutoload)->registerHooks();
(new ThemeSetup)->registerHooks();
(new JsonConfig)->setup();

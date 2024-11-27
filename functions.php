<?php

namespace Capitaine;

# Inclure les fichiers
require_once __DIR__ . '/inc/binding.php';
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/custom-post-types.php';
require_once __DIR__ . '/inc/editor.php';


# Initialiser les classes
(new Binding)->execute();
(new Config)->execute();
(new CPT)->execute();
(new Editor)->execute();

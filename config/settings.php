<?php
declare(strict_types=1);

$settings = require __DIR__ . '/defaults.php';

// Overwrite default settings with environment specific local settings
//if (file_exists(__DIR__ . '/environments/env.prod.php')) {
//    require __DIR__ . '/environments/env.dev.php';
//}

require __DIR__ . '/environments/env.local.php';

return $settings;
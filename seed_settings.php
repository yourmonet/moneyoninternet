<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AppSetting;

AppSetting::setSetting('favicon', 'https://cdn-1.yourmonet.web.id/images/monet.png');
AppSetting::setSetting('logo_light', 'https://cdn-1.yourmonet.web.id/images/monet2.png');
AppSetting::setSetting('logo_dark', 'https://cdn-1.yourmonet.web.id/images/monet-2.png');
AppSetting::setSetting('logo_grey', 'https://cdn-1.yourmonet.web.id/images/monet-greycolor.png');

echo "Settings saved.\n";

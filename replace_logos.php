<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

$replacements = [
    'https://cdn-1.yourmonet.web.id/images/monet.png' => '{{ app_setting(\'favicon\', \'https://cdn-1.yourmonet.web.id/images/monet.png\') }}',
    'https://cdn-1.yourmonet.web.id/images/monet2.png' => '{{ app_setting(\'logo_light\', \'https://cdn-1.yourmonet.web.id/images/monet2.png\') }}',
    'https://cdn-1.yourmonet.web.id/images/monet-2.png' => '{{ app_setting(\'logo_dark\', \'https://cdn-1.yourmonet.web.id/images/monet-2.png\') }}',
    'https://cdn-1.yourmonet.web.id/images/monet-greycolor.png' => '{{ app_setting(\'logo_grey\', \'https://cdn-1.yourmonet.web.id/images/monet-greycolor.png\') }}',
];

foreach ($files as $file) {
    $filePath = $file[0];
    // skip settings.blade.php to avoid double replacement
    if (strpos($filePath, 'settings.blade.php') !== false) {
        continue;
    }
    
    $content = file_get_contents($filePath);
    $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
    
    if ($content !== $newContent) {
        file_put_contents($filePath, $newContent);
        echo "Updated: $filePath\n";
    }
}

echo "Done replacing logos in blade templates.\n";

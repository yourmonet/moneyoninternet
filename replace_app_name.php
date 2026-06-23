<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($files as $file) {
    $filePath = $file[0];
    
    // Skip settings.blade.php just in case, though the regex should handle it
    if (strpos($filePath, 'settings.blade.php') !== false) {
        continue;
    }
    
    $content = file_get_contents($filePath);
    
    // Replace MONET with {{ app_setting('app_name', 'MONET') }}
    // But ONLY if it is not surrounded by single quotes to avoid replacing inside the default value 'MONET'
    $newContent = preg_replace("/(?<!')MONET(?!')/", "{{ app_setting('app_name', 'MONET') }}", $content);
    
    if ($content !== $newContent) {
        file_put_contents($filePath, $newContent);
        echo "Updated: $filePath\n";
    }
}

echo "Done replacing MONET in blade templates.\n";

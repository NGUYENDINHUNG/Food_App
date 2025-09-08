<?php
$source = __DIR__ . '/storage/app/public/';
$destination = __DIR__ . '/public/storage/';

function copyDirectory($src, $dst) {
    $dir = opendir($src);
    if (!file_exists($dst)) {
        mkdir($dst, 0755, true);
    }
    
    while(($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);                                                                       
            }
        }
    }
    closedir($dir);
}

// Copy categories
copyDirectory($source . 'categories', $destination . 'categories');
echo "✅ Copied categories\n";

// Copy foods  
copyDirectory($source . 'foods', $destination . 'foods');
echo "✅ Copied foods\n";

echo "🎉 Sync completed!";
?>
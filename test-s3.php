<?php
require 'vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Test upload
    $testContent = 'test content';
    $path = 'test/test.txt';
    
    Storage::disk('s3')->put($path, $testContent);
    echo "Upload successful!\n";
    
    // Set public visibility
    Storage::disk('s3')->setVisibility($path, 'public');
    echo "Set public visibility successful!\n";
    
    // Test URL
    $url = Storage::disk('s3')->url($path);
    echo "URL: $url\n";
    
    // Test access
    $headers = get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        echo "File is accessible!\n";
    } else {
        echo "File is NOT accessible!\n";
        echo "Response: " . $headers[0] . "\n";
        
        // Try to get more info
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'User-Agent: Mozilla/5.0'
            ]
        ]);
        
        $response = file_get_contents($url, false, $context);
        if ($response === false) {
            echo "Failed to get content\n";
        } else {
            echo "Content: " . substr($response, 0, 100) . "\n";
        }
    }
    
    // Clean up
    Storage::disk('s3')->delete($path);
    echo "Clean up successful!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
<?php
$directory = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$iterator = new RecursiveIteratorIterator($directory);
$regex = new RegexIterator($iterator, '/^.+\.blade\.php$/i', RecursiveRegexIterator::GET_MATCH);

$countReplaced = 0;

foreach ($regex as $file) {
    $path = $file[0];
    // Skip the layout files and components for the regex replacement to avoid removing our toast included
    $basename = basename($path);
    
    $content = file_get_contents($path);
    
    // Replace the block @if(session('success')) ... @endif
    // We use ungreedy match .*? to not swallow multiple ifs if they exist on the same page.
    $pattern = '/@if\(\s*session\(\'success\'\)\s*\).*?@endif/is';
    
    // Check if the pattern exists before replacing
    if (preg_match($pattern, $content)) {
        $newContent = preg_replace($pattern, '', $content);
        file_put_contents($path, $newContent);
        echo "Removed success block from: $path\n";
        $countReplaced++;
    }
}

// Now include toast in layouts
$layouts = [
    __DIR__ . '/resources/views/layouts/admin.blade.php',
    __DIR__ . '/resources/views/layouts/customer.blade.php',
    __DIR__ . '/resources/views/layouts/technician.blade.php',
    __DIR__ . '/resources/views/layouts/app.blade.php',
];

foreach ($layouts as $layout) {
    if (file_exists($layout)) {
        $content = file_get_contents($layout);
        if (strpos($content, "@include('components.toast')") === false) {
            // Replace </body> with @include('components.toast') \n </body>
            $newContent = str_replace('</body>', "@include('components.toast')\n</body>", $content);
            file_put_contents($layout, $newContent);
            echo "Added toast to layout: $layout\n";
        }
    }
}

echo "Done! Replaced $countReplaced files.\n";

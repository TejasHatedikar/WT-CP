<?php
// index.php
$files = ['subjects.html', 'timelines.html', 'domain.html', 'documentation.html', 'project.html'];
$index = [];

foreach ($files as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        // Strip HTML tags and store the text content
        $text = strip_tags($content);
        // Store the text and file name in the index
        $index[$file] = $text;
    }
}

// Save the index to a session or file for later use
session_start();
$_SESSION['index'] = $index;
?>
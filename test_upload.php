<?php
$file = 'uploads/test.txt';
file_put_contents($file, 'This is a test file.');

if (file_exists($file)) {
    echo "✅ File successfully created in uploads!";
} else {
    echo "❌ Error: PHP cannot write to uploads directory.";
}
?>

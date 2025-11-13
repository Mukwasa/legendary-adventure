<?php
// Installation and Setup Script
// Run this script to check if everything is configured correctly

echo "<h1>TO-DO App Installation Check</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .check{background:#f5f5f5;padding:15px;margin:10px 0;border-radius:5px;} .success{background:#d4edda;border:1px solid #c3e6cb;} .error{background:#f8d7da;border:1px solid #f5c6cb;} .warning{background:#fff3cd;border:1px solid #ffeaa7;} pre{background:#f8f9fa;padding:10px;border-radius:4px;overflow-x:auto;}</style>";

$checks = [];
$allPassed = true;

// Check 1: PHP Version
echo "<h2>System Requirements Check</h2>";
$phpVersion = phpversion();
$phpOk = version_compare($phpVersion, '7.0.0', '>=');
$checks[] = $phpOk;
echo "<div class='check " . ($phpOk ? 'success' : 'error') . "'>";
echo "<h3>PHP Version</h3>";
echo "<p>Current: PHP $phpVersion</p>";
echo "<p>Required: PHP 7.0+</p>";
echo "<p>" . ($phpOk ? "✅ Pass" : "❌ Fail") . "</p>";
echo "</div>";

// Check 2: PDO Extension
$pdoOk = extension_loaded('pdo') && extension_loaded('pdo_mysql');
$checks[] = $pdoOk;
echo "<div class='check " . ($pdoOk ? 'success' : 'error') . "'>";
echo "<h3>PDO MySQL Extension</h3>";
echo "<p>" . ($pdoOk ? "✅ PDO MySQL extension is loaded" : "❌ PDO MySQL extension is missing") . "</p>";
echo "</div>";

// Check 3: Database Connection
echo "<h2>Database Connection Check</h2>";
try {
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    
    if ($db) {
        echo "<div class='check success'>";
        echo "<h3>Database Connection</h3>";
        echo "<p>✅ Successfully connected to MySQL database</p>";
        echo "</div>";
        
        // Check if table exists
        $stmt = $db->query("SHOW TABLES LIKE 'tasks'");
        $tableExists = $stmt->rowCount() > 0;
        
        echo "<div class='check " . ($tableExists ? 'success' : 'warning') . "'>";
        echo "<h3>Tasks Table</h3>";
        if ($tableExists) {
            echo "<p>✅ Tasks table exists</p>";
            
            // Check table structure
            $stmt = $db->query("DESCRIBE tasks");
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo "<p>Table columns: " . implode(', ', $columns) . "</p>";
        } else {
            echo "<p>⚠️ Tasks table does not exist</p>";
            echo "<p>Please run the SQL script in database/schema.sql</p>";
        }
        echo "</div>";
        
        $checks[] = true;
    } else {
        throw new Exception("Database connection failed");
    }
} catch (Exception $e) {
    $checks[] = false;
    echo "<div class='check error'>";
    echo "<h3>Database Connection</h3>";
    echo "<p>❌ Failed to connect to database</p>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Please check your database configuration in config/database.php</p>";
    echo "</div>";
}

// Check 4: File Permissions
echo "<h2>File System Check</h2>";
$files = [
    'config/database.php',
    'models/Task.php',
    'api/items.php',
    'index.html',
    'assets/css/style.css',
    'assets/js/app.js'
];

$allFilesExist = true;
foreach ($files as $file) {
    $exists = file_exists($file);
    $allFilesExist = $allFilesExist && $exists;
    echo "<div class='check " . ($exists ? 'success' : 'error') . "'>";
    echo "<p>" . ($exists ? "✅" : "❌") . " $file</p>";
    echo "</div>";
}
$checks[] = $allFilesExist;

// Check 5: Web Server
echo "<h2>Web Server Check</h2>";
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
echo "<div class='check success'>";
echo "<h3>Web Server</h3>";
echo "<p>✅ Server: $serverSoftware</p>";
echo "<p>✅ Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "</p>";
echo "</div>";

// Final Summary
echo "<h2>Installation Summary</h2>";
$passedChecks = array_sum($checks);
$totalChecks = count($checks);

if ($passedChecks == $totalChecks) {
    echo "<div class='check success'>";
    echo "<h3>🎉 Installation Complete!</h3>";
    echo "<p>All checks passed! Your TO-DO app is ready to use.</p>";
    echo "<p><a href='index.html' style='background:#007cba;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;'>Open TO-DO App</a></p>";
    echo "<p><a href='test_api.php' style='background:#28a745;color:white;padding:10px 20px;text-decoration:none;border-radius:4px;margin-left:10px;'>Test API</a></p>";
    echo "</div>";
} else {
    echo "<div class='check error'>";
    echo "<h3>⚠️ Installation Issues Found</h3>";
    echo "<p>$passedChecks out of $totalChecks checks passed.</p>";
    echo "<p>Please fix the issues above before using the application.</p>";
    echo "</div>";
}

// Quick Setup Instructions
echo "<h2>Quick Setup Instructions</h2>";
echo "<div class='check'>";
echo "<h3>If you haven't set up the database yet:</h3>";
echo "<ol>";
echo "<li>Start XAMPP and ensure MySQL is running</li>";
echo "<li>Open phpMyAdmin (http://localhost/phpmyadmin)</li>";
echo "<li>Import the file: <code>database/schema.sql</code></li>";
echo "<li>Refresh this page to verify the setup</li>";
echo "</ol>";
echo "</div>";

echo "<div class='check'>";
echo "<h3>API Endpoints Available:</h3>";
echo "<ul>";
echo "<li><code>GET /api/items.php</code> - Get all tasks</li>";
echo "<li><code>GET /api/items.php/{id}</code> - Get single task</li>";
echo "<li><code>POST /api/items.php</code> - Create new task</li>";
echo "<li><code>PUT /api/items.php/{id}</code> - Update task</li>";
echo "<li><code>DELETE /api/items.php/{id}</code> - Delete task</li>";
echo "</ul>";
echo "</div>";
?>



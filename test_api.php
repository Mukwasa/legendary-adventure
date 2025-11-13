<?php
// API Test Script
//  testing all CRUD operations

require_once 'config/database.php';

echo "<h1>TO-DO API Test Results</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .test{background:#f5f5f5;padding:10px;margin:10px 0;border-left:4px solid #007cba;} .success{background:#d4edda;border-left-color:#28a745;} .error{background:#f8d7da;border-left-color:#dc3545;} pre{background:#f8f9fa;padding:10px;border-radius:4px;overflow-x:auto;}</style>";

$baseUrl = 'http://localhost' . dirname($_SERVER['PHP_SELF']) . '/api/items.php';

function testEndpoint($method, $url, $data = null, $expectedStatus = 200) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    $success = ($httpCode == $expectedStatus) && !$error;
    $class = $success ? 'success' : 'error';
    
    echo "<div class='test $class'>";
    echo "<h3>$method $url</h3>";
    echo "<p><strong>Status:</strong> $httpCode (Expected: $expectedStatus)</p>";
    if ($error) {
        echo "<p><strong>Error:</strong> $error</p>";
    }
    echo "<p><strong>Response:</strong></p>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
    echo "</div>";
    
    return $success;
}

// Test 1: Get all tasks
echo "<h2>Test 1: GET All Tasks</h2>";
testEndpoint('GET', $baseUrl);

// Test 2: Create a new task
echo "<h2>Test 2: POST Create Task</h2>";
$newTask = [
    'title' => 'Test Task from PHP',
    'description' => 'This task was created by the test script',
    'completed' => false
];
$createResult = testEndpoint('POST', $baseUrl, $newTask, 201);

// Test 3: Get single task (assuming task with ID 1 exists)
echo "<h2>Test 3: GET Single Task</h2>";
testEndpoint('GET', $baseUrl . '/1');

// Test 4: Update task
echo "<h2>Test 4: PUT Update Task</h2>";
$updateData = [
    'title' => 'Updated Test Task',
    'description' => 'This task was updated by the test script',
    'completed' => true
];
testEndpoint('PUT', $baseUrl . '/1', $updateData);

// Test 5: Delete task (be careful with this in production!)
echo "<h2>Test 5: DELETE Task</h2>";
echo "<p><em>Note: This will delete task with ID 1. Make sure you have test data!</em></p>";
// Uncomment the next line to test deletion
// testEndpoint('DELETE', $baseUrl . '/1');

echo "<h2>Test Summary</h2>";
echo "<p>All tests completed. Check the results above for any errors.</p>";
echo "<p>If all tests show green (success), your API is working correctly!</p>";
?>



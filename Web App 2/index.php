<?php
require 'vendor/autoload.php';

try {
    // Connect to Redis using the service name defined in docker-compose
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host'   => 'redis', 
        'port'   => 6379,
    ]);

    // 1. Get the total visit count recorded by App 1
    $totalVisits = $redis->get('visit_count') ?? 0;

    // 2. Get the total number of messages collected in the Redis list
    $totalMessages = $redis->llen('messages_log');

} catch (Exception $e) {
    die("Unable to connect to Redis: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevOpsHub - Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .stat-card {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            border-top: 5px solid #3498db;
        }
        .stat-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #2980b9;
            display: block;
        }
        .stat-label {
            font-size: 1em;
            color: #7f8c8d;
            margin-top: 10px;
        }
        .refresh-note {
            margin-top: 25px;
            font-size: 0.85em;
            color: #95a5a6;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>DevOpsHub Dashboard</h2>
        
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-value"><?php echo $totalMessages; ?></span>
                <span class="stat-label">Total Messages Collected</span>
            </div>
            <div class="stat-card">
                <span class="stat-value"><?php echo $totalVisits; ?></span>
                <span class="stat-label">Total Page Visits</span>
            </div>
        </div>

        <p class="refresh-note">Data refreshes on each page load.</p>
    </div>
</body>
</html>
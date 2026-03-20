<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CI/CD Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        .info-box {
            background: #f9f9f9;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #4CAF50;
        }
        .time-box {
            font-size: 24px;
            text-align: center;
            padding: 20px;
            background: #e8f5e9;
            border-radius: 5px;
            margin: 20px 0;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #45a049;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .version {
            background: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 PHP CI/CD Demo Application</h1>
        
        <div class="version">
            Version: 1.0.1
        </div>
        
        <div class="info-box">
            <h3>📡 Server Information</h3>
            <?php
            // Simple PHP server info
            echo "<p><strong>Server Time:</strong> " . date('Y-m-d H:i:s') . "</p>";
            echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
            echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
            ?>
        </div>
        
        <div class="time-box" id="live-time">
            <!-- JavaScript will update this -->
            Loading live time...
        </div>
        
        <button onclick="refreshTime()">🔄 Refresh Time</button>
        <button onclick="checkHealth()">🏥 Health Check</button>
        
        <div id="message" style="margin-top: 20px; padding: 10px; display: none;"></div>
        
        <div class="footer">
            <p>Deployed via GitHub Actions CI/CD | <?php echo date('Y'); ?></p>
        </div>
    </div>
    
    <script>
        // Simple JavaScript function for live updates
        function refreshTime() {
            document.getElementById('live-time').innerHTML = 'Loading...';
            
            fetch('time.php')
                .then(response => response.text())
                .then(time => {
                    document.getElementById('live-time').innerHTML = '🕐 Live Time: ' + time;
                })
                .catch(error => {
                    document.getElementById('live-time').innerHTML = 'Error loading time';
                });
        }
        
        function checkHealth() {
            fetch('health.php')
                .then(response => response.json())
                .then(data => {
                    let messageDiv = document.getElementById('message');
                    messageDiv.style.display = 'block';
                    messageDiv.style.background = '#e8f5e9';
                    messageDiv.innerHTML = '✅ Health Check: ' + data.status + ' (Response time: ' + data.time + 'ms)';
                })
                .catch(error => {
                    let messageDiv = document.getElementById('message');
                    messageDiv.style.display = 'block';
                    messageDiv.style.background = '#ffebee';
                    messageDiv.innerHTML = '❌ Health Check Failed';
                });
        }
        
        // Load time when page loads
        window.onload = function() {
            refreshTime();
        };
    </script>
</body>
</html>
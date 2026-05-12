<?php
session_start();

// Increment visit counter on each page load
if (!isset($_SESSION['page_visits_counter'])) {
    $_SESSION['page_visits_counter'] = 0;
}
$_SESSION['page_visits_counter']++;
$visits = $_SESSION['page_visits_counter'];

// Initialize message list in session if it doesn't exist
if (!isset($_SESSION['submitted_messages_list'])) {
    $_SESSION['submitted_messages_list'] = [];
}

// Handle form submission
$statusMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        // Add submitted message to the session list
        $_SESSION['submitted_messages_list'][] = $message;
        $statusMessage = 'Message submitted successfully!';
    } else {
        $statusMessage = 'Please enter a message.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Form</title>
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
            max-width: 500px;
            width: 100%;
        }

        h2,
        h3 {
            color: #2c3e50;
            margin-top: 0;
        }

        .visit-counter {
            font-size: 0.9em;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
            margin-bottom: 15px;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
            resize: vertical;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Submit a Message</h2>

        <p class="visit-counter">This page has been visited <strong><?php echo $visits; ?></strong> times.</p>

        <?php if ($statusMessage): ?>
            <p class="<?php echo strpos($statusMessage, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($statusMessage); ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="message">Your Message:</label><br>
                <textarea id="message" name="message" rows="4" cols="50" required></textarea>
            </div>
            <br>
            <button type="submit">Submit Message</button>
        </form>
    </div>
</body>

</html>
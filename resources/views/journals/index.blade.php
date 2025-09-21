<?php
// Assuming $journals and session data are passed from the controller
$journals = isset($journals) ? $journals : [];
$success = session('success');

function str_limit($string, $length) {
    // Simple PHP equivalent of Laravel's Str::limit
    return strlen($string) > $length ? substr($string, 0, $length) . '...' : $string;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Journal Entries - Bloomify</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4b0082;
            font-size: 24px;
            margin-bottom: 16px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
        .journal-entry {
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .journal-entry h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .journal-entry .date {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .journal-entry p {
            color: #4b5563;
            font-size: 16px;
        }
        .no-entries {
            color: #6b7280;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Journal Entries 📔</h2>

        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (count($journals) > 0): ?>
            <?php foreach ($journals as $journal): ?>
                <div class="journal-entry">
                    <h3><?php echo htmlspecialchars($journal->title); ?></h3>
                    <p class="date">Written on <?php echo (new DateTime($journal->created_at))->format('M d, Y'); ?></p>
                    <p><?php echo htmlspecialchars(str_limit($journal->content, 150)); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-entries">No journal entries yet. Start writing one!</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
// Assuming $mood is passed from the controller
$mood = isset($mood) ? $mood : new stdClass();
$mood->mood = isset($mood->mood) ? $mood->mood : '';
$mood->note = isset($mood->note) ? $mood->note : '';
$mood->created_at = isset($mood->created_at) ? new DateTime($mood->created_at) : new DateTime();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Details - Bloomify</title>
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
        .card {
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            margin-bottom: 16px;
        }
        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }
        .card-text {
            color: #4b5563;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .text-muted {
            color: #6b7280;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-secondary {
            background-color: #6b7280;
            color: #fff;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mood Details</h2>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($mood->mood); ?></h4>
                <p class="card-text"><?php echo htmlspecialchars($mood->note) ?: 'No additional notes.'; ?></p>
                <small class="text-muted">Logged: <?php echo $mood->created_at->format('D, M d, Y, h:i A'); ?></small>
            </div>
        </div>

        <a href="/moods/edit/<?php echo $mood->id; ?>" class="btn btn-warning">Edit</a>
        <form action="/moods/<?php echo $mood->id; ?>" method="POST" style="display:inline">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger">Delete</button>
        </form>
        <a href="/moods" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
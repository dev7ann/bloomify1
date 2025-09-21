<?php
// Assuming $moods and session data are passed from the controller
$moods = isset($moods) ? $moods : [];
$success = session('success');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Moods - Bloomify</title>
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4b0082;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .btn-primary {
            background-color: #4b0082;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #6a0dad;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
        .list-group {
            list-style: none;
            padding: 0;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            margin-bottom: 8px;
            background-color: #f9fafb;
        }
        .list-group-item small {
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Moods</h2>

        <a href="/moods/create" class="btn btn-primary">Log New Mood</a>

        <?php if ($success): ?>
            <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <ul class="list-group">
            <?php if (count($moods) > 0): ?>
                <?php foreach ($moods as $mood): ?>
                    <li class="list-group-item">
                        <span>
                            <strong><?php echo htmlspecialchars($mood->mood); ?></strong> - <?php echo htmlspecialchars($mood->note); ?>
                            <br><small><?php echo (new DateTime($mood->created_at))->format('M d, Y, H:i'); ?></small>
                        </span>
                        <span>
                            <a href="/moods/edit/<?php echo $mood->id; ?>" class="btn btn-warning">Edit</a>
                            <form action="/moods/<?php echo $mood->id; ?>" method="POST" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No moods logged yet.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
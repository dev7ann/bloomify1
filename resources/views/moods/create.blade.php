<?php
// No variables needed from controller for create
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log a Mood - Bloomify</title>
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
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            color: #1f2937;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-control:focus {
            outline: none;
            border-color: #4b0082;
            box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
        }
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Log a Mood</h2>

        <form action="/moods" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label for="mood">Mood</label>
                <input type="text" name="mood" id="mood" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="note">Note (optional)</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save Mood</button>
        </form>
    </div>
</body>
</html>
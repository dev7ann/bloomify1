<?php
$users = isset($users) ? $users : [];
$activeUsers = isset($activeUsers) ? $activeUsers : 0;
$newSignups = isset($newSignups) ? $newSignups : 0;
$totalMoods = isset($totalMoods) ? $totalMoods : 0;
$totalJournals = isset($totalJournals) ? $totalJournals : 0;
$moodTrends = isset($moodTrends) ? $moodTrends : [];
$tips = isset($tips) ? $tips : [];
$signupTrends = isset($signupTrends) ? $signupTrends : [];
$success = session('success');
$error = session('error');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bloomify</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1, h2 {
            color: #4b0082;
        }
        .section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background-color: #4b0082;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #6a0dad;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px;
            border: 1px solid #e2e8f0;
        }
        .table th {
            background-color: #4b0082;
            color: #fff;
        }
        .chart-container {
            max-width: 500px;
            margin: 20px auto;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <?php if ($success): ?>
            <div class="alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Platform Stats -->
        <div class="section">
            <h2>Platform Stats</h2>
            <p>Active Users (Last 30 Days): <?php echo $activeUsers; ?></p>
            <p>New Signups (Last 30 Days): <?php echo $newSignups; ?></p>
            <p>Total Moods: <?php echo $totalMoods; ?></p>
            <p>Total Journals: <?php echo $totalJournals; ?></p>
            <div class="chart-container">
                <canvas id="signupChart"></canvas>
            </div>
            <script>
                new Chart(document.getElementById('signupChart'), {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_keys($signupTrends)); ?>,
                        datasets: [{
                            label: 'New Signups per Month',
                            data: <?php echo json_encode(array_values($signupTrends)); ?>,
                            backgroundColor: '#4b0082',
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true, title: { display: true, text: 'Signups' } },
                            x: { title: { display: true, text: 'Month' } }
                        }
                    }
                });
            </script>
        </div>

        <!-- Mood & Journal Analytics -->
        <div class="section">
            <h2>Mood & Journal Analytics</h2>
            <div class="chart-container">
                <canvas id="moodTrendChart"></canvas>
            </div>
            <script>
                new Chart(document.getElementById('moodTrendChart'), {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode(array_keys($moodTrends)); ?>,
                        datasets: [
                            {
                                label: 'Happy',
                                data: <?php echo json_encode(array_column($moodTrends, 'happy')); ?>,
                                backgroundColor: '#28a745',
                            },
                            {
                                label: 'Calm',
                                data: <?php echo json_encode(array_column($moodTrends, 'calm')); ?>,
                                backgroundColor: '#007bff',
                            },
                            {
                                label: 'Excited',
                                data: <?php echo json_encode(array_column($moodTrends, 'excited')); ?>,
                                backgroundColor: '#ffc107',
                            },
                            {
                                label: 'Anxious',
                                data: <?php echo json_encode(array_column($moodTrends, 'anxious')); ?>,
                                backgroundColor: '#fd7e14',
                            },
                            {
                                label: 'Sad',
                                data: <?php echo json_encode(array_column($moodTrends, 'sad')); ?>,
                                backgroundColor: '#dc3545',
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true, title: { display: true, text: 'Count' } },
                            x: { title: { display: true, text: 'Month' } }
                        }
                    }
                });
            </script>
        </div>

        <!-- User Management -->
        <div class="section">
            <h2>User Management</h2>
            <form action="/admin/users" method="GET" class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->name); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                            <td>
                                <form action="/admin/users/<?php echo $user->id; ?>/role" method="POST">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="_method" value="PUT">
                                    <select name="usertype" class="form-control" onchange="this.form.submit()">
                                        <option value="user" <?php echo $user->usertype === 'user' ? 'selected' : ''; ?>>User</option>
                                        <option value="admin" <?php echo $user->usertype === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="/admin/users/<?php echo $user->id; ?>" method="POST" style="display:inline">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" <?php echo $user->id === Auth::id() ? 'disabled' : ''; ?>>Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Wellness Tip Management -->
        <div class="section">
            <h2>Wellness Tip Management</h2>
            <form action="/admin/wellness-tips" method="POST" class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add Tip</button>
            </form>

            <h3 class="mt-4">Existing Tips</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tips as $tip): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tip->title); ?></td>
                            <td><?php echo htmlspecialchars($tip->category ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($tip->creator ? $tip->creator->name : 'N/A'); ?></td>
                            <td>
                                <form action="/admin/wellness-tips/<?php echo $tip->id; ?>" method="POST" style="display:inline">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="text" name="title" value="<?php echo htmlspecialchars($tip->title); ?>" class="form-control" required>
                                    <textarea name="content" class="form-control" required><?php echo htmlspecialchars($tip->content); ?></textarea>
                                    <input type="text" name="category" value="<?php echo htmlspecialchars($tip->category ?? ''); ?>" class="form-control">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form action="/admin/wellness-tips/<?php echo $tip->id; ?>" method="POST" style="display:inline">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
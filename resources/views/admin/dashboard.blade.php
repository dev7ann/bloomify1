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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* Basic styles */
/* 🌐 Base reset */
* {
  box-sizing: border-box;
}

/* 🌿 App background */
body {
  font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #f5f3ff, #eef2ff);
  margin: 0;
  padding: 0;
  color: #374151;
}

/* 📦 Main container */
.container {
  max-width: 1200px;
  margin: auto;
  padding: 24px;
}

/* ✨ Headings */
h1 {
  color: #4b0082;
  font-size: 32px;
  margin-bottom: 16px;
}

h2 {
  color: #5b21b6;
  font-size: 22px;
  margin-bottom: 12px;
}

/* 🧱 Section cards */
.section {
  background: #ffffff;
  padding: 24px;
  border-radius: 14px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
  margin-bottom: 24px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.section:hover {
  transform: translateY(-3px);
  box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08);
}

/* 📊 Tables */
.table {
  width: 100%;
  border-collapse: collapse;
  overflow: hidden;
  border-radius: 10px;
}

.table th,
.table td {
  padding: 14px;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}

.table th {
  background: linear-gradient(135deg, #4b0082, #6a0dad);
  color: #ffffff;
  font-weight: 600;
}

.table tr:hover {
  background-color: #f5f3ff;
}

/* 📝 Inputs */
.form-control {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  transition: border 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus {
  outline: none;
  border-color: #6a0dad;
  box-shadow: 0 0 0 3px rgba(106, 13, 173, 0.15);
}

/* 🔘 Buttons */
.btn {
  padding: 10px 18px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* 🟣 Primary */
.btn-primary {
  background: linear-gradient(135deg, #4b0082, #6a0dad);
  color: #ffffff;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #5b21b6, #7c3aed);
}

/* 🔴 Danger */
.btn-danger {
  background: linear-gradient(135deg, #dc3545, #b91c1c);
  color: #ffffff;
}

/* 📈 Chart card */
.chart-container {
  max-width: 650px;
  margin: 32px auto;
  background: #ffffff;
  padding: 20px;
  border-radius: 14px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
}

/* ✅ Alerts */
.alert-success {
  background: #ecfdf5;
  color: #065f46;
  padding: 14px;
  border-radius: 10px;
  margin-bottom: 16px;
  border-left: 5px solid #10b981;
}

.alert-error {
  background: #fef2f2;
  color: #7f1d1d;
  padding: 14px;
  border-radius: 10px;
  margin-bottom: 16px;
  border-left: 5px solid #ef4444;
}

/* 🚫 Utility */
.hidden {
  display: none;
}

/* 📊 Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-bottom: 32px;
}

/* 🧊 Stat Cards */
.stat-card {
  padding: 22px;
  border-radius: 16px;
  color: #ffffff;
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  position: relative;
  overflow: hidden;
}

.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 35px rgba(0, 0, 0, 0.2);
}

/* Card heading */
.stat-card h3 {
  font-size: 15px;
  font-weight: 500;
  margin-bottom: 10px;
  opacity: 0.9;
}

/* Main number */
.stat-card p {
  font-size: 30px;
  font-weight: 700;
  margin: 0;
}

/* Small helper text */
.stat-card span {
  font-size: 12px;
  opacity: 0.85;
}

/* 🎨 Color Variants */
.stat-card.purple {
  background: linear-gradient(135deg, #4b0082, #7c3aed);
}

.stat-card.blue {
  background: linear-gradient(135deg, #2563eb, #3b82f6);
}

.stat-card.green {
  background: linear-gradient(135deg, #16a34a, #22c55e);
}

.stat-card.yellow {
  background: linear-gradient(135deg, #f59e0b, #fbbf24);
  color: #1f2933;
}

/* Optional: glow effect */
.stat-card::after {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.08);
  opacity: 0;
  transition: opacity 0.2s ease;
}

.stat-card:hover::after {
  opacity: 1;
}


</style>
</head>
<body>
<div class="container">
<h1>Admin Dashboard</h1>

<div style="position:absolute; top:24px; right:24px;">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">
            Logout
        </button>
    </form>
</div>


<?php if($success): ?>
<div class="alert-success"><?= htmlspecialchars($success); ?></div>
<?php endif; ?>
<?php if($error): ?>
<div class="alert-error"><?= htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Sidebar Navigation -->
<div style="display:flex; gap:20px; margin-bottom:20px;">
    <button class="btn btn-primary" onclick="scrollToSection('platformStats')">Platform Stats</button>
    <button class="btn btn-primary" onclick="scrollToSection('moodAnalytics')">Mood Analytics</button>
    <button class="btn btn-primary" onclick="scrollToSection('userManagement')">Users</button>
    <button class="btn btn-primary" onclick="scrollToSection('tipsManagement')">Wellness Tips</button>
</div>

<!-- Platform Stats with Cards -->
<div class="section" id="platformStats">
    <h2>Platform Stats</h2>
    <div class="stats-grid">

    <div class="stat-card purple">
        <h3>Active Users</h3>
        <p><?= $activeUsers ?></p>
        <span>Currently active</span>
    </div>

    <div class="stat-card blue">
        <h3>New Signups</h3>
        <p><?= $newSignups ?></p>
        <span>This period</span>
    </div>

    <div class="stat-card green">
        <h3>Total Moods</h3>
        <p><?= $totalMoods ?></p>
        <span>Tracked moods</span>
    </div>

    <div class="stat-card yellow">
        <h3>Total Journals</h3>
        <p><?= $totalJournals ?></p>
        <span>Journal entries</span>
    </div>

</div>


    <div class="chart-container">
        <canvas id="signupChart"></canvas>
    </div>
</div>


<!-- Mood & Journal Analytics -->
<div class="section" id="moodAnalytics">
<h2>Mood Analytics</h2>
<div class="chart-container">
<canvas id="moodTrendChart"></canvas>
</div>
</div>

<!-- User Management -->
<div class="section" id="userManagement">
<h2>User Management</h2>
<form id="userSearchForm" class="form-group">
{{-- <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email">
<button type="submit" class="btn btn-primary">Search</button> --}}
</form>

<table class="table">
 <thead>
    <tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
 </thead>
<tbody id="usersTable">
    <?php foreach($users as $user): ?>
<tr data-user-id="<?= $user->id ?>">
        <td><?= htmlspecialchars($user->name) ?></td>
        <td><?= htmlspecialchars($user->email) ?></td>
<td>
<select class="form-control roleSelect">
    <option value="user" <?= $user->usertype==='user'?'selected':'' ?>>User</option>
    <option value="admin" <?= $user->usertype==='admin'?'selected':'' ?>>Admin</option>
</select>
</td>
<td>
    <button class="btn btn-danger deleteUserBtn" <?= $user->id===Auth::id()?'disabled':'' ?>>Delete</button>
</td>
</tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>

<!-- Wellness Tips -->
<div class="section" id="tipsManagement">
    <h2>Wellness Tip Management</h2>
    <button class="btn btn-primary" onclick="toggleForm('addTipForm')">Add New Tip</button>

    <!-- Add Tip Form -->
    <form id="addTipForm" action="/admin/wellness-tips" method="POST" class="form-group hidden">
      <label>Select Existing Tip:</label>
          <select id="tipSelect" class="form-control">
              <option value="">-- Reuse existing tip --</option>

              <?php foreach($tips as $tip): ?>
                  <option 
                      value="<?= htmlspecialchars($tip->content) ?>"
                      data-title="<?= htmlspecialchars($tip->title) ?>"
                      data-category="<?= htmlspecialchars($tip->category) ?>">
                      
                      <?= htmlspecialchars($tip->title) ?> - <?= substr($tip->content, 0, 40) ?>...
                  </option>
              <?php endforeach; ?>

          </select>
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
        <div class="form-group">
            <label>Title</label>
           <input type="text" id="titleInput" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Content</label>
          <textarea id="contentInput" name="content" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
           <input type="text" id="categoryInput" name="category" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Tip</button>
    </form>

    <h3 class="mt-4">Existing Tips</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Content</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tipsTable">
            <?php foreach($tips as $tip): ?>
            <tr data-tip-id="<?= $tip->id ?>">
                <td><?= htmlspecialchars($tip->title) ?></td>
                <td><?= htmlspecialchars($tip->category ?? 'General') ?></td>
                <td><?= htmlspecialchars($tip->content) ?></td>
                <td><?= htmlspecialchars(optional($tip->creator)->name ?? 'Admin') ?></td>
                <td>
                    <!-- Edit Form (hidden, toggled) -->
                    <button class="btn btn-primary" onclick="toggleEditForm(<?= $tip->id ?>)">Edit</button>
                    <form action="/admin/wellness-tips/<?= $tip->id ?>" method="POST" style="display:inline-block;">
                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>

                    <form id="editTipForm-<?= $tip->id ?>" action="/admin/wellness-tips/<?= $tip->id ?>" method="POST" class="form-group hidden mt-2">
                        <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" name="title" value="<?= htmlspecialchars($tip->title) ?>" class="form-control mb-1" placeholder="Title">
                        <input type="text" name="category" value="<?= htmlspecialchars($tip->category) ?>" class="form-control mb-1" placeholder="Category">
                        <textarea name="content" class="form-control mb-1" placeholder="Content"><?= htmlspecialchars($tip->content) ?></textarea>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function toggleForm(id){
    const form = document.getElementById(id);
    form.classList.toggle('hidden');
}

function toggleEditForm(id){
    const form = document.getElementById('editTipForm-' + id);
    form.classList.toggle('hidden');
}
</script>

<script>
document.getElementById('tipSelect').addEventListener('change', function() {
    let selected = this.options[this.selectedIndex];

    document.getElementById('titleInput').value = selected.dataset.title || '';
    document.getElementById('contentInput').value = selected.value || '';
    document.getElementById('categoryInput').value = selected.dataset.category || '';
});
</script>

<style>
.hidden { display: none; }
</style>


<script>
// Scroll to section
function scrollToSection(id){ document.getElementById(id).scrollIntoView({behavior:'smooth'}); }
// Toggle add tip form
function toggleForm(id){ document.getElementById(id).classList.toggle('hidden'); }

// Chart.js setup
let signupChart = new Chart(document.getElementById('signupChart'), {
    type:'bar',
    data:{
        labels: <?= json_encode(array_keys($signupTrends)) ?>,
        datasets:[{label:'New Signups per Month', data:<?= json_encode(array_values($signupTrends)) ?>, backgroundColor:'#4b0082'}]
    },
    options:{ scales:{y:{beginAtZero:true}, x:{}} }
});

let moodTrendChart = new Chart(document.getElementById('moodTrendChart'), {
    type:'bar',
    data:{
        labels: <?= json_encode(array_keys($moodTrends)) ?>,
        datasets:[
            {label:'Happy', data:<?= json_encode(array_column($moodTrends,'happy')) ?>, backgroundColor:'#28a745'},
            {label:'Calm', data:<?= json_encode(array_column($moodTrends,'calm')) ?>, backgroundColor:'#007bff'},
            {label:'Excited', data:<?= json_encode(array_column($moodTrends,'excited')) ?>, backgroundColor:'#ffc107'},
            {label:'Anxious', data:<?= json_encode(array_column($moodTrends,'anxious')) ?>, backgroundColor:'#fd7e14'},
            {label:'Sad', data:<?= json_encode(array_column($moodTrends,'sad')) ?>, backgroundColor:'#dc3545'}
        ]
    },
    options:{ scales:{y:{beginAtZero:true}, x:{}} }
});

// AJAX User Role Update
document.querySelectorAll('.roleSelect').forEach(select=>{
    select.addEventListener('change',function(){
        let userId = this.closest('tr').dataset.userId;
        fetch(`/admin/users/${userId}/role`,{
            method:'PUT',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'<?= csrf_token() ?>'},
            body: JSON.stringify({usertype:this.value})
        }).then(res=>res.json()).then(data=>alert('Role updated!'));
    });
});

// AJAX User Delete
document.querySelectorAll('.deleteUserBtn').forEach(btn=>{
    btn.addEventListener('click',function(){
        if(!confirm('Are you sure?')) return;
        let tr = this.closest('tr');
        let userId = tr.dataset.userId;
        fetch(`/admin/users/${userId}`,{method:'DELETE', headers:{'X-CSRF-TOKEN':'<?= csrf_token() ?>'}})
        .then(()=> tr.remove());
    });
});


</script>
</body>
</html>

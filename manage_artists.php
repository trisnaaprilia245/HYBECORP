<?php
require_once 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $newArtist = [
            'id' => 'art' . uniqid(),
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'debut' => $_POST['debut'],
            'image' => $_POST['image'],
            'status' => $_POST['status'],
            'type' => $_POST['type']
        ];
        $artists[] = $newArtist;
    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        $artists = array_filter($artists, fn($a) => $a['id'] !== $id);
    }
    
    header('Location: manage_artists.php');
    exit;
}

$pageTitle = "Manage Artists";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= SITE_NAME ?> | <?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">HYBE Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="manage_artists.php">Manage Artists</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?= $_SESSION['user']['name'] ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h2 class="mb-4">Manage Artists</h2>
        
        <!-- Add Artist Form -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Add New Artist</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Artist Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="debut" class="form-label">Debut Date</label>
                            <input type="date" class="form-control" id="debut" name="debut" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Artist Type</label>
                            <select class="form-select" name="type" required>
                                <option value="boy-group">Boy Group</option>
                                <option value="girl-group">Girl Group</option>
                                <option value="solo">Solo Artist</option>
                                <option value="band">Band</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-danger">Add Artist</button>
                </form>
            </div>
        </div>
        
        <!-- Artists List -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Current Artists</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($artists as $artist): ?>
                                <tr>
                                    <td><img src="<?= $artist['image'] ?>" width="50" height="50" class="rounded-circle"></td>
                                    <td><?= $artist['name'] ?></td>
                                    <td><?= ucfirst(str_replace('-', ' ', $artist['type'] ?? 'N/A')) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $artist['status'] === 'active' ? 'success' : 'secondary' ?>">
                                            <?= ucfirst($artist['status'] ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="post" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $artist['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
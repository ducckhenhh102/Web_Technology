<?php
require 'hienthihoa.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa đẹp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flower-card {
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .flower-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .flower-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }
        .card-title {
            color: #198754; 
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">



<div class="container">
    <h1 class="text-center text-success mb-5">Danh sách các loài hoa đẹp</h1>
    
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($flowers as $flower): ?>
            <div class="col">
                <div class="card h-100 flower-card">
                    <?php 
                        $imagePath = file_exists($flower['image']) ? $flower['image'] : 'https://via.placeholder.com/400x300?text=No+Image';
                    ?>
                    <img src="<?php echo $imagePath; ?>" class="card-img-top flower-img" alt="<?php echo $flower['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                        <p class="card-text text-secondary"><?php echo $flower['description']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
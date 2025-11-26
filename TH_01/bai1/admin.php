<?php
require 'hienthihoa.php';
session_start();


?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị danh sách Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>



<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý danh sách hoa</h2>
    
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Tên Hoa</th>
                    <th scope="col" style="width: 40%;">Mô tả</th>
                    <th scope="col" class="text-center">Hình ảnh</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td class="text-center"><?php echo $index + 1; ?></td>
                        <td class="fw-bold text-primary"><?php echo $flower['name']; ?></td>
                        <td><?php echo $flower['description']; ?></td>
                        <td class="text-center">
                            <?php 
                                $imagePath = file_exists($flower['image']) ? $flower['image'] : 'https://via.placeholder.com/100x80?text=No+Image';
                            ?>
                            <img src="<?php echo $imagePath; ?>" alt="Anh hoa" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5px;">
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="#" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash"></i> Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


</body>
</html>
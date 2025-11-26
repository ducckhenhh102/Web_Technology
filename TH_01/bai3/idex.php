<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Điểm danh (Từ CSV)</title>
    <style>
        /* Reset CSS cơ bản */
        * { box-sizing: border-box; font-family: "Segoe UI", Arial, sans-serif; }
        
        body { 
            background-color: #f4f7f6; 
            margin: 0; 
            padding: 20px; 
            color: #333;
        }

        /* Container chính */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            text-transform: uppercase;
            font-size: 1.5rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            display: inline-block;
        }
        
        /* Căn giữa tiêu đề */
        .heading-wrapper { text-align: center; }

        /* Style cho bảng dữ liệu */
        .table-wrapper {
            overflow-x: auto; /* Cho phép cuộn ngang trên mobile */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 0.95rem;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: white;
            font-weight: 600;
            white-space: nowrap; /* Không xuống dòng tiêu đề */
        }

        /* Zebra striping (Màu xen kẽ cho dòng) */
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef; /* Hiệu ứng khi di chuột qua */
        }

        /* Thông báo lỗi/cảnh báo */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: bold;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        /* Khu vực chân trang (nút bấm) */
        .footer-action {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .total-count {
            color: #7f8c8d;
            font-style: italic;
        }

        /* Style cho nút bấm */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #219150;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="heading-wrapper">
        <h2>Danh Sách Sinh Viên (Đọc từ CSV)</h2>
    </div>

    <?php
    $filename = '65HTTT_Danh_sach_diem_danh.csv';
    $data = [];

    if (file_exists($filename)) {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            // Đọc dòng đầu tiên làm header
            $headers = fgetcsv($handle, 1000, ",");
            
            // Đọc dữ liệu
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);
        }
    } else {
        echo "<div class='alert alert-danger'>Lỗi: Không tìm thấy file <strong>$filename</strong></div>";
    }
    ?>

    <?php if (!empty($data)): ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($headers as $header): ?>
                            <th><?php echo htmlspecialchars($header); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $student): ?>
                        <tr>
                            <?php foreach ($student as $cell): ?>
                                <td><?php echo htmlspecialchars($cell); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="footer-action">
            <span class="total-count">Tổng số sinh viên: <strong><?php echo count($data); ?></strong></span>
            <button class="btn btn-success">Lưu vào CSDL (Coming soon)</button>
        </div>

    <?php else: ?>
        <div class="alert alert-warning">File CSV rỗng hoặc chưa đọc được dữ liệu.</div>
    <?php endif; ?>

</div>

</body>
</html>
<?php
// index.php - Trang Quan Ly Danh Sach Diem Den

include_once 'config.php';

// --- Logic Xoa (DELETE) ---
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM destinations WHERE destination_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=deleted"); // Tai lai trang sau khi xoa
        exit();
    } else {
        echo "Loi khi xoa: " . $conn->error;
    }
    $stmt->close();
}

// --- Logic Lay Du Lieu (READ) ---
$sql = "
    SELECT 
        d.destination_id, d.name, d.country, d.created_at, u.username
    FROM 
        destinations d
    JOIN 
        users u ON d.created_by = u.user_id
    ORDER BY 
        d.created_at DESC
";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Admin - Quan Ly Diem Den</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .action-link { margin-right: 10px; }
    </style>
</head>
<body>

    <h2>🗺️ Quan Ly Diem Den Du Lich</h2>
    <a href="form.php" class="action-link">➕ Them Diem Den Moi</a>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green; font-weight: bold;">Thao tac thanh cong!</p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ten Diem Den</th>
                <th>Quoc Gia</th>
                <th>Nguoi Tao</th>
                <th>Ngay Tao</th>
                <th>Hanh Dong</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0): 
                while($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['destination_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                <td>
                    <a href="form.php?id=<?php echo $row['destination_id']; ?>" class="action-link">Sua</a>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['destination_id']; ?>">
                        <button type="submit" onclick="return confirm('Ban co chac chan muon xoa diem den nay?');">Xoa</button>
                    </form>
                </td>
            </tr>
            <?php 
                endwhile; 
            else: 
            ?>
            <tr><td colspan="6">Khong co diem den nao.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
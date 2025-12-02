<?php
// form.php - Trang Them moi & Sua doi Diem Den

include_once 'config.php';

$destination = [
    'destination_id' => null,
    'name' => '',
    'country' => '',
    'description' => '',
    'image_url' => '',
    'created_by' => 1 // Mac dinh nguoi tao
];
$is_edit = false;
$error_message = '';
$users = getUsers($conn); // Lay danh sach users

// --- Logic Cap nhat (UPDATE) & Lay du lieu cu ---
if (isset($_GET['id'])) {
    $is_edit = true;
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE destination_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $destination = $result->fetch_assoc();
    } else {
        $error_message = "Khong tim thay diem den nay.";
        $is_edit = false; // Chuyen ve che do them moi neu khong tim thay
    }
    $stmt->close();
}

// --- Logic Xu ly Form POST (CREATE hoac UPDATE) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $created_by = $_POST['created_by'];

    if ($is_edit) {
        // Cap nhat (UPDATE)
        $id = $_POST['destination_id'];
        $sql = "UPDATE destinations SET name=?, country=?, description=?, image_url=?, created_by=? WHERE destination_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $name, $country, $description, $image_url, $created_by, $id);
    } else {
        // Them moi (CREATE)
        $sql = "INSERT INTO destinations (name, country, description, image_url, created_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $country, $description, $image_url, $created_by);
    }

    if ($stmt->execute()) {
        header("Location: index.php?success=saved");
        exit();
    } else {
        $error_message = "Loi khi luu du lieu: " . $conn->error;
        // Giu lai du lieu da nhap trong form
        $destination = $_POST; 
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title><?php echo $is_edit ? 'Sua' : 'Them'; ?> Diem Den</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 600px; display: grid; gap: 10px; padding: 20px; border: 1px solid #ccc; }
        label { font-weight: bold; }
        input[type="text"], textarea, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2><?php echo $is_edit ? '✍️ Cap Nhat Diem Den' : '➕ Them Diem Den Moi'; ?></h2>
    <a href="index.php">← Quay lai danh sach</a>

    <?php if ($error_message): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST" action="form.php">
        <?php if ($is_edit): ?>
            <input type="hidden" name="destination_id" value="<?php echo $destination['destination_id']; ?>">
        <?php endif; ?>
        
        <label for="name">Ten Diem Den:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($destination['name']); ?>" required>
        
        <label for="country">Quoc Gia:</label>
        <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($destination['country']); ?>" required>
        
        <label for="description">Mo ta:</label>
        <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($destination['description']); ?></textarea>
        
        <label for="image_url">URL Anh chinh (Tam thoi):</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($destination['image_url']); ?>">

        <label for="created_by">Nguoi Tao/Dong Gop:</label>
        <select name="created_by" id="created_by" required>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['user_id']; ?>" 
                    <?php echo ($user['user_id'] == $destination['created_by']) ? 'selected' : ''; ?>>
                    <?php echo $user['username']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit"><?php echo $is_edit ? 'Luu Thay Doi' : 'Them Diem Den'; ?></button>
    </form>

</body>
</html>
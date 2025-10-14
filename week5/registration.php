<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="login-box">
    <div class="login-left">
        <h2>Register</h2>
        <form action="validation.php" method="post">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="student_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Class Name</label>
                <input type="text" name="class_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
</div>

</body>
</html>

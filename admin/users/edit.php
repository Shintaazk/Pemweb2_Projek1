<?php
require_once '../layout/header.php';
require_once '../layout/sidebar.php';

require '../dbkoneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Query to retrieve user data based on id
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    $_id = $_POST['user_id']; // Change variable name to $_id
    $_username = $_POST['username'];
    $_password = $_POST['password'];
    $_email = $_POST['email'];
    $_created_at = $_POST['created_at'];

        // Hash the password
        $_hashed_password = password_hash($_password, PASSWORD_DEFAULT);

    $data = [$_id, $_username, $_hashed_password, $_email, $_created_at, $id]; // Change $id to $_id
    // Query SQL to update user data based on id
    $sql = "UPDATE users SET user_id = ?, username = ?, password = ?, email = ?, created_at = ? WHERE user_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    echo "<script>window.location.href = 'index.php';</script>";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #d1e9af;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Website</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form User</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="text-center">Form User</h2>
                            <form action="edit.php?id=<?= $row['user_id'] ?>" method="POST"> <!-- Update URL parameter to use 'id' -->
                                <div class="form-group row">
                                    <label for="user_id" class="col-4 col-form-label">User ID </label>
                                    <div class="col-8">
                                        <input id="user_id" name="user_id" type="text" class="form-control" value="<?= $row['user_id'] ?>"> <!-- Update value to use 'id' -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">Username</label>
                                    <div class="col-8">
                                        <input id="username" name="username" type="text" class="form-control" value="<?= $row['username'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email" type="text" class="form-control" value="<?= $row['email'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input id="password" name="password" type="password" class="form-control" value="<?= $row['password'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="created_at" class="col-4 col-form-label">Created At</label>
                                    <div class="col-8">
                                        <input id="created_at" name="created_at" type="datetime-local" class="form-control" value="<?= $row['created_at'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once '../layout/footer.php';
?>

<?php
require_once __DIR__ . "/ManageUsers.php";
if(!isset($_GET["id"]) or empty($_GET["id"])) {
    include_once __DIR__ . "/partials/not_found.php";
    exit();
}

$manager_users = new ManageUsers();
$userId = $_GET["id"];
$user = $manager_users->GetUser($userId);

if(empty($user)) {
    include_once __DIR__ . "/partials/not_found.php";
    exit();
}

//update user
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $updateUser = $manager_users->UpdateUser($userId, $_POST);
    if(!empty($_FILES["picture"]["name"])) {
        $manager_users->UploadImage($user, $_FILES, $updateUser);
    }
    header("Location: index.php");

}
?>
<?php require_once __DIR__ . "/partials/header.php"; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h2>Update User</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?php echo  $user["name"]?>" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" value="<?php echo  $user["username"]?>" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" value="<?php echo  $user["email"]?>" class="form-control" name="email" id="Email">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" value="<?php echo  $user["phone"]?>" class="form-control" name="phone" id="phone">
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" value="<?php echo  $user["website"]?>" class="form-control" name="website" id="website">
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Picture</label>
                    <input accept=".png,.jpg" type="file" class="form-control" name="picture" id="picture">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-dark">Back</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/partials/footer.php"; ?>

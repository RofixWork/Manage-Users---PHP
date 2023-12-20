<?php
require_once __DIR__ . "/partials/header.php";
require_once __DIR__ . "/ManageUsers.php";
$errors = [
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
    "website" => "",
];
$user_data =[
    "name" => "",
    "username" => "",
    "email" => "",
    "phone" => "",
    "website" => "",
];
$isValid = true;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $website = $_POST["website"];
//    check inputs
    if(empty($name)) {
        $errors["name"] = "name is required";
        $isValid = false;
    }else {
        $user_data["name"] = $name;
    }

    if(empty($username) || strlen($username) < 6 || strlen($username) > 12) {

        $errors["username"] = "username is required and it must be than 6 and less than 12 character";
        $isValid = false;
    } else {
        $user_data["username"] = $username;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors["email"] = "invalid format email";
        $isValid = false;
    } else {
        $user_data["email"] = $email;
    }

    if(!filter_var($phone, FILTER_VALIDATE_INT)) {

        $errors["phone"] = "the must be a valid phone number";
        $isValid = false;
    } else {
        $user_data["phone"] = $phone;
    }

    if(empty($website)) {

        $errors["website"] = "website is required";
        $isValid = false;
    } else {
        $user_data["website"] = $website;
    }

//    check inputs
if($isValid) {
    $id = rand(100000, 200000);
    $user = array_merge($_POST, ["id" => $id]);

    if(!empty($_FILES["picture"]["name"])) {
        //        check folder (images)
        if(!file_exists(__DIR__ . "/users/images")) {
            mkdir(__DIR__ . "/users/images");
        }
//       get file extension
        $file_extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
//        file location
        $from = $_FILES["picture"]["tmp_name"];
        $to = __DIR__ . "/users/images/{$user["id"]}.{$file_extension}";

        move_uploaded_file($from, $to);
        $user["extension"] = $file_extension;
    }
    $manage = new ManageUsers();
    $manage->CreateUser($user);
    header("Location: index.php");
}


    echo "</pre>";
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h2>Create User</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="<?php echo $user_data["name"] ?>" type="text" class="form-control <?= empty($errors["name"]) ? "" : "is-invalid" ?>" name="name" id="name">
                    <div class="invalid-feedback">
                        <?php echo $errors["name"]?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="<?php echo $user_data["username"] ?>" type="text" class="form-control <?= empty($errors["username"]) ? "" : "is-invalid" ?>" name="username" id="username">
                    <div class="invalid-feedback">
                        <?php echo $errors["username"]?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" value="<?php echo $user_data["email"] ?>"  class="form-control <?= empty($errors["email"]) ? "" : "is-invalid" ?>" name="email" id="Email">
                    <div class="invalid-feedback">
                        <?php echo $errors["email"]?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" value="<?php echo $user_data["phone"] ?>" class="form-control <?= empty($errors["phone"]) ? "" : "is-invalid" ?>" name="phone" id="phone">
                    <div class="invalid-feedback">
                        <?php echo $errors["phone"]?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" value="<?php echo $user_data["website"] ?>" class="form-control <?= empty($errors["website"]) ? "" : "is-invalid" ?>" name="website" id="website">
                    <div class="invalid-feedback">
                        <?php echo $errors["website"]?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Picture</label>
                    <input accept=".png,.jpg" type="file" class="form-control" name="picture" id="picture">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="index.php" class="btn btn-dark">Back</a>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/partials/footer.php"; ?>

<?php
require_once __DIR__ . "/ManageUsers.php";
require_once __DIR__ . "/partials/header.php";

$manage_users = new ManageUsers();
$users = $manage_users->GetUsers();

?>

    <h1>
        <a class="btn btn-outline-success btn-lg mx-2" href="create.php">Create A new User</a>
    </h1>
    <?php if(count($users)) { ?>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Website</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) :?>
                <tr>
                    <th scope="row">
<!--                        //check image-->
                        <?php if(isset($user["extension"]) and file_exists(__DIR__ . "/users/images/{$user["id"]}.{$user["extension"]}")) { ?>
                         <img width="100px" height="100px" src="<?php echo "users/images/{$user["id"]}.{$user["extension"]}"?>" alt="" /> </th>
                        <?php } else { ?>
                            <?php echo "..."?>
                        <?php } ?>
<!--                    //check image-->

                    <th ><?php echo $user["name"] ? $user["name"] : "Not Available"?></th>
                    <th ><?php echo $user["username"] ? $user["username"] : "Not Available"?></th>
                    <th ><?php echo $user["email"] ? $user["email"] : "Not Available"?></th>
                    <th ><?php echo $user["phone"] ? $user["phone"] : "Not Available"?></th>
                    <th ><?php
                        if($user["website"]) {
                            echo "<a href='https://{$user['website']}'>{$user['website']}</a>";
                        }else {
                            echo 'Not Available';
                        }
                    ?></th>
                    <th >
                        <a href="view.php?id=<?php echo $user["id"]?>" type="button" class="btn btn-primary">view</a>
                        <a href="update.php?id=<?php echo $user["id"]?>" type="button" class="btn btn-secondary">Update</a>
                        <a href="delete.php?id=<?php echo $user["id"]?>" type="button" class="btn btn-danger">Delete</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Not exist Any Users...
        </div>
    <?php } ?>



<?php require_once __DIR__ . "/partials/footer.php"?>





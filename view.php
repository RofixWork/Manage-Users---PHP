<?php
require_once __DIR__ . "/ManageUsers.php";
if(!isset($_GET["id"]) or empty($_GET["id"])) {
   require_once __DIR__ . "/partials/not_found.php";
   exit();
}

$manager_users = new ManageUsers();
$user = $manager_users->GetUser($_GET["id"]);

if(empty($user)) {
   require_once __DIR__ . "/partials/not_found.php";
   exit();
}
?>
<?php require_once __DIR__ . "/partials/header.php"; ?>
<div>
   <h3>
      <span>Name:</span>
      <strong><?php echo $user["name"]?></strong>
   </h3>
   <hr>
   <h3>
      <span>Username:</span>
      <strong><?php echo $user["username"]?></strong>
   </h3>
   <hr>
   <h3>
      <span>Email:</span>
      <strong><?php echo $user["email"]?></strong>
   </h3>
   <hr>
   <h3>
      <span>Phone:</span>
      <strong><?php echo $user["phone"]?></strong>
   </h3>
   <hr>
   <h3>
      <span>Website</span>
      <strong><?php
         if($user["website"]) {
            echo "<a href='https://{$user['website']}'>{$user['website']}</a>";
         }else {
            echo 'Not Available';
         }
         ?></strong>
   </h3>
   <hr>
   <a href="index.php" class="btn btn-dark">Back</a>
</div>
<?php require_once __DIR__ . "/partials/footer.php"; ?>
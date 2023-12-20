<?php
require_once __DIR__ . "/helpers/Crud.php";
class ManageUsers implements CrudOperations
{

    public function GetUsers()
    {
        $filename = __DIR__ . "/users/users.json";
        return json_decode(file_get_contents($filename), TRUE);
    }

    public function GetUser(int $id)
    {
        $users = self::GetUsers();
        foreach ($users as $user) {
            if($user["id"] === $id) {
                return $user;
            }
        }
        return null;
    }

    public function CreateUser($data)
    {
        $users = self::GetUsers();

        $users[] = $data;

        file_put_contents(__DIR__ . "/users/users.json", json_encode($users, JSON_PRETTY_PRINT));
    }

    public function UpdateUser(int $id, $data)
    {
        $users = $this->GetUsers();

        foreach ($users as $index => $user):
            if($user["id"] == $id) {
                $users[$index] = $updateUser = array_merge($user, $data);
            }
        endforeach;
        file_put_contents(__DIR__ . "/users/users.json", json_encode($users, JSON_PRETTY_PRINT));

        return $updateUser;
    }

    public function DeleteUser(int $id) : void
    {
        $users = self::GetUsers();
        $filter_users = array_filter($users, fn($user) => $user["id"] !== $id);

        file_put_contents(__DIR__ . "/users/users.json", json_encode($filter_users, JSON_PRETTY_PRINT));

    }

    function UploadImage($user, $file, $updateUser) : void{
        //        check folder (images)
        if(!file_exists(__DIR__ . "/users/images")) {
            mkdir(__DIR__ . "/users/images");
        }
//       get file extension
        $file_extension = pathinfo($file["picture"]["name"], PATHINFO_EXTENSION);
//        file location
        $from = $file["picture"]["tmp_name"];
        $to = __DIR__ . "/users/images/{$user["id"]}.{$file_extension}";
//       save file
        move_uploaded_file($from, $to);
        $updateUser["extension"] = $file_extension;
        self::UpdateUser($user["id"], $updateUser);
    }
}
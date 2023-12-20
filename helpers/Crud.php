<?php
interface CrudOperations {
    public function GetUsers();
    public function GetUser(int $id);
    public function CreateUser($data);
    public function UpdateUser(int $id, $data);
    public function DeleteUser(int $id);

}
<?php

header('Content-Type: application/json');

require_once __DIR__ . '/includes/db/db.php';

$method = $_SERVER['REQUEST_METHOD'];
$DB = new \DB\db\DB();

switch ($method) {
    case 'GET':
        $users = $DB->select('SELECT * FROM users ORDER BY id DESC LIMIT 10 ');
        echo json_encode($users);
        break;

    case 'POST':
        $errors = [];
        $response = [];

        $name = $_POST['name'] ?? "";
        $address = $_POST['address'] ?? "";
        $phone = $_POST['phone'] ?? "";
        $email = $_POST['email'] ?? "";

        function test_input($data): string
        {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        if (empty($_POST["name"])) {
            $errors["name"] = "Вы забыли про ФИО!";
        } else {
            $name = test_input($_POST["name"]);

            if (!preg_match("/^.+\s.+\s?.*$/", $name)) {
                $errors["name"] = "ФИО введено не корректно";
            }
        }

        if (empty($_POST["address"])) {
            $errors["address"] = "Вы забыли про адрес!";
        } else {
            $address = test_input($_POST["address"]);
        }

        if (empty($_POST["phone"])) {
            $errors["phone"] = "Вы забыли про телефон!";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $phone)) {
                $errors["phone"] = "Номер телефона введен некорректно.";
            }
        }

        if (empty($_POST["email"])) {
            $errors["email"] = "Вы забыли про Email!";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Email введен некорректно";
            }
        }

        if (!empty($errors)) {
            $response['errors'] = $errors;
            echo json_encode([
                "success" => false,
                "errors" => $errors
            ]);
            break;
        }

        $DB->insert(
            'INSERT INTO users (name, address, phone, email) VALUES (:name, :address, :phone, :email)',
            [":name" => $name, ":address" => $address, ":phone" => $phone, ":email" => $email]
        );

        echo json_encode([
            "success" => true,
            "message" => "Данные получены"
        ]);

        break;
}







<?php

class Users extends Controller
{
    public function index()
    {
        $data['users'] = $this->model('User')->get_all();
        $this->view('home', $data);
    }

    public function updated_user_table()
    {
        $data['users'] = $this->model('User')->get_all();
        $this->view('users/table', $data);
    }

    public function show($id)
    {
        $data['user'] = $this->model('User')->get_one($id);
        $this->view('users/show', $data);
    }

    public function create()
    {
        $this->view('users/create');
    }

    public function create_post()
    {
        $name = $email = $password = $card_number = "";
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST['name'])) {
                $name = $this->validate_input($_POST['name']);
            } else {
                $errors['name'] = 'Name field is required';
            }

            if (!empty($_POST['email'])) {
                $email = $this->validate_input($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Invalid email format";
                } elseif ($this->model('User')->check_email($email)) {
                    $errors['email'] = "Email field must be unique";
                }
            } else {
                $errors['email'] = 'Email field is required';
            }

            if (!empty($_POST['password'])) {
                $password = $this->validate_input($_POST['password']);
                if (strlen($password) < 6) {
                    $errors['password'] = 'Password field must be at least 6 characters';
                } elseif (!preg_match("#[0-9]+#", $password)) {
                    $errors['password'] = 'Password field must Contain at least 1 number';
                } elseif (!preg_match("#[A-Z]+#", $password)) {
                    $errors['password'] = "Password field must contain at least 1 capital letter";
                } elseif (!preg_match("#[a-z]+#", $password)) {
                    $errors['password'] = "Password field must contain at least 1 lowercase letter";
                }
            } else {
                $errors['password'] = 'Password field is required';
            }

            if (!empty($_POST['card_number'])) {
                $card_number = $this->validate_input($_POST['card_number']);
                if (strlen($card_number) != 16) {
                    $errors['card_number'] = 'Card number field must be 16 characters';
                } elseif (!is_numeric($card_number)) {
                    $errors['card_number'] = 'Card number characters must be numbers';
                }
            } else {
                $errors['card_number'] = 'Card number field is required';
            }


            if (count($errors) > 0) {
                $data['status'] = 0;
                $data['errors'] = $errors;
                echo json_encode($data);
            } else {
                // make the insert to the data base
                $user['name'] = $name;
                $user['email'] = $email;
                $user['password'] = password_hash($password, PASSWORD_DEFAULT);
                $user['card_number'] = $card_number;

                // make the insert
                $this->model('User')->insert($user);
                $data['status'] = 1;
                $data['msg'] = "User added successfully";
                echo json_encode($data);
            }


        }


    }

    public function edit($id)
    {
        $data['user'] = $this->model('User')->get_one($id);
        $this->view('users/edit', $data);
    }

    public function edit_post($id)
    {
        $name = $email = $password = $card_number = "";
        $errors = [];
        $user_data = $this->model('User')->get_one($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST['name'])) {
                $name = $this->validate_input($_POST['name']);
            } else {
                $errors['name'] = 'Name field is required';
            }

            if (!empty($_POST['email'])) {
                $email = $this->validate_input($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Invalid email format";
                } elseif ($this->model('User')->check_email($email, $id)) {
                    $errors['email'] = "Email field must be unique";
                }
            } else {
                $errors['email'] = 'Email field is required';
            }

            if (!empty($_POST['password'])) {
                $password = $this->validate_input($_POST['password']);
                if (strlen($password) < 6) {
                    $errors['password'] = 'Password field must be at least 6 characters';
                } elseif (!preg_match("#[0-9]+#", $password)) {
                    $errors['password'] = 'Password field must Contain at least 1 number';
                } elseif (!preg_match("#[A-Z]+#", $password)) {
                    $errors['password'] = "Password field must contain at least 1 capital letter";
                } elseif (!preg_match("#[a-z]+#", $password)) {
                    $errors['password'] = "Password field must contain at least 1 lowercase letter";
                }
            }

            if (!empty($_POST['card_number'])) {
                $card_number = $this->validate_input($_POST['card_number']);
                if (strlen($card_number) != 16) {
                    $errors['card_number'] = 'Card number field must be 16 characters';
                } elseif (!is_numeric($card_number)) {
                    $errors['card_number'] = 'Card number characters must be numbers';
                }
            } else {
                $errors['card_number'] = 'Card number field is required';
            }


            if (count($errors) > 0) {
                $data['status'] = 0;
                $data['errors'] = $errors;
                echo json_encode($data);
            } else {

                $user['name'] = $name;
                $user['email'] = $email;
                if (!empty($password)) {
                    $user['password'] = password_hash($password, PASSWORD_DEFAULT);
                } else {
                    $user['password'] = $user_data->password;
                }
                $user['card_number'] = $card_number;

//                print_r($user);

                // make the update
                $this->model('User')->update($user, $id);
                $data['status'] = 1;
                $data['from_update'] = 1;
                $data['msg'] = "User Updated successfully";
                echo json_encode($data);
            }

        }


    }

    public function delete($id, $md5_id)
    {
        if (md5($id) == $md5_id) {

            $this->model('User')->delete($id);
            $data['status'] = 1;
            $data['delete_id'] = $id;
            echo json_encode($data);
        }
    }

    private function validate_input($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input);
        return $input;
    }

}
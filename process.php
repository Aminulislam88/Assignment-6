<?php
// Validate form inputs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_FILES['profile_pic']['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $profile_pic = $_FILES['profile_pic'];

            // Create directory if not exists
            if (!is_dir('uploads')) {
                mkdir('uploads');
            }

            // Generate unique filename
            $filename = 'uploads/' . uniqid() . '_' . $profile_pic['name'];

            // Append current date and time to filename
            $filename = date('Ymd_His') . '_' . $filename;

            // Save profile picture to server
            move_uploaded_file($profile_pic['tmp_name'], $filename);

            // Save user data to CSV file
            $data = [$name, $email, $filename];
            $file = fopen('users.csv', 'a');
            fputcsv($file, $data);
            fclose($file);

            // Start session and set cookie with user's name
            session_start();
            $_SESSION['name'] = $name;
            setcookie('name', $name, time() + (86400 * 30), '/'); // Cookie expires in 30 days

            // Redirect to success page
            header('Location: success.php');
            exit;
        } else {
            echo 'Invalid email format.';
        }
    } else {
        echo 'Please fill out all fields.';
    }
}
?>


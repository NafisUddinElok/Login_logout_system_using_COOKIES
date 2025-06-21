<?php
session_start();

$correct_username = 'admin';
$correct_password = '12345';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if($username == $correct_username && $password == $correct_password){
        $_SESSION['username'] = $username;

        if(isset($_POST['remember'])){
            setcookie('remember_user', $username, time() + (7 * 24 * 60 * 60)); // cookie for 7 days
        } else {
            setcookie('remember_user', '', time() - 3600);  
        }

        header('Location: welcome.php');
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<h2> Login </h2>

<?php 
if(!empty($error_message)){
    echo "<p style = 'color : red;'> $error </p>";
}
?>
<form method = "post" >
    <input type = "text" name = "username" placeholder = "Username"
        value = "<?= htmlspecialchars($_COOKIE['remember_user'] ?? '') ?>" > <br>

    <input type = "password" name = "password" placeholder = "Password"><br>

    <label>
        <input type = "checkbox" name = "remember" 
            <?= isset($_COOKIE['remember_user']) ? 'checked' : ''  ?>>
        Remember me
    </label><br>
    <button type = "submit"> login </button>
</form>
<?php
require_once './backOffice/config/function.php';
session_start();

$login = new Login();
if (isset($_POST['submit'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $result = $login->login($username, $password);
    if ($result === 1) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $login->idUser();
        header('Location: ../frontOffice/homeUser.php');
        exit();
    } elseif ($result === 10) {
        $error = "Incorrect password.";
    } elseif ($result === 100) {
        $error = "User not found.";
    } else {
        $error = "An unknown error occurred.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Improved Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-fixed">
    <header class="flex justify-between items-center px-6 py-4">
        <h1 class="text-2xl font-extrabold">TASKFLOW</h1>
        <div>
            <button><a href="../frontOffice/register.php" id="sign_up" class="p-2 text-xl font-bold rounded-lg hover:bg-violet-600">Sign Up</a></button>
        </div>
    </header>
    <section id="FormSignIn" class="flex flex-col items-center w-full max-w-lg mx-auto mt-10 p-6">
        <h2 class="text-2xl font-bold mb-4">Log In</h2>  
        <form action="" method="post" class="w-full space-y-4">
            <div>
                <label for="username" class="block text-xl font-bold">Name</label>
                <input id="username" name="username" type="text" placeholder="Enter your name" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <div>
                <label for="password" class="block text-xl font-bold">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <input type="submit" value="Log In" name="submit" class="w-full p-3 mt-4 font-bold text-white bg-black rounded-lg hover:bg-green-600">
        </form>
        <?php if (isset($error)): ?>
            <div class="text-red-600 mt-4"><?php echo $error; ?></div>
        <?php endif; ?>
    </section>
</body>
</html>

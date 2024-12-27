<?php
require '../backOffice/config/function.php';

$login = new login();
if (isset($_POST['submit'])) {

    $resulte = $login->login($_POST['username'], $_POST['password']);
    if ($resulte = 1) {
        $_SESSION['login'] = $true;
        $_SESSION['id'] = $login->idUser();
        header('location: ../frontOffice/homeUser.php');

    }
    if ($resulte = 10) {
        
    }
    if ($resulte = 100) {
        
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
                <label for="first-name" class="block text-xl font-bold">Name</label>
                <input id="first-name" name="name" type="text" placeholder="Enter your name" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <div>
                <label for="password" class="block text-xl font-bold">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <input type="submit" value="log in" name="submit2" class="w-full p-3 mt-4 font-bold text-white bg-black rounded-lg hover:bg-green-600">
        </form>
        <div class ="text-red-600">
        </div>
    </section>
    <script src="./js/login.js" ></script>
</body>
</html>

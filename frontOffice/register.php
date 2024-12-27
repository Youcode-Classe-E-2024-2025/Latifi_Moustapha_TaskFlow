<?php

require '../backOffice/config/function.php';

$register = new Register();

if(isset($_POST['submit'])) {
    $resulte = $register->registrartion($_POST['name'], $_POST['email'], $_POST['password']);

    if($resulte == 1) {
        echo"<scrept>  alert('registration successful')  <scrept/>";
    }
    if($resulte == 10) {
        echo"<scrept>  alert('Name or Email has already taken')  <scrept/>";
    } if($resulte == 100) {
        echo"<scrept>  alert('password does not match')  <scrept/>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/output.css">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-fixed">
    <header class="flex justify-between items-center px-6 py-4">
        <h1 class="text-2xl font-extrabold">TASKFLOW</h1>
        <div>
            <button><a href="../frontOffice/login.php" id="sign_up" class="p-2 text-xl font-bold rounded-lg hover:bg-violet-600">Sign in</a></button>
        </div>
    </header>

    <section id="FormSignUp" class="flex flex-col items-center w-full max-w-lg mx-auto mt-10 p-6" >
        <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
        <form action="" method="post" class="w-full space-y-4">
            <div>
                <label for="name" class="block text-xl font-bold">Name</label>
                <input id="name" name="name" type="text" placeholder="Enter name" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <div>
                <label for="email" class="block text-xl font-bold">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <div>
                <label for="password" class="block text-xl font-bold">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <div>
                <label for="confermpassword" class="block text-xl font-bold">confer your Password</label>
                <input id="confermpassword" name="confermpassword" type="password" placeholder="conferm your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            </div>
            <button type="submit" name="submit"  class="w-full p-3 mt-4 font-bold text-white bg-black rounded-lg hover:bg-green-600">
                Submit
            </button>
        </form>
        <?php
        ?>
    </section>
</body>
</html>

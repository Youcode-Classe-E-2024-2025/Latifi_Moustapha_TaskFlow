<?php
require './backOffice/config/function.php'; 

$register = new Register();
$message = '';

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confermpassword']));

    $result = $register->registrartion($name, $email, $password, $confirmPassword);

    if ($result == 1) {
        $message = "Registration successful!";
    } elseif ($result == 10) {
        $message = "Name or Email has already been taken.";
    } elseif ($result == 100) {
        $message = "Passwords do not match.";
    } else {
        $message = "An unknown error occurred.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/output.css">
    <title>Taskflow - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-fixed">
    <header class="flex justify-between items-center px-6 py-4">
        <h1 class="text-2xl font-extrabold">TASKFLOW</h1>
        <div>
            <button>
                <a href="../frontOffice/login.php" id="sign_up" class="p-2 text-xl font-bold rounded-lg hover:bg-violet-600">Sign in</a>
            </button>
        </div>
    </header>

    <section id="FormSignUp" class="flex flex-col items-center w-full max-w-lg mx-auto mt-10 p-6">
        <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
        
        <!-- Affichage du message -->
        <?php if (!empty($message)): ?>
            <div class="w-full p-3 mb-4 text-white <?php echo $result == 1 ? 'bg-green-500' : 'bg-red-500'; ?> rounded-lg">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" class="w-full space-y-4">
            <div>
                <label for="name" class="block text-xl font-bold">Name</label>
                <input id="name" name="name" type="text" placeholder="Enter name" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <div>
                <label for="email" class="block text-xl font-bold">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <div>
                <label for="password" class="block text-xl font-bold">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <div>
                <label for="confermpassword" class="block text-xl font-bold">Confirm Password</label>
                <input id="confermpassword" name="confermpassword" type="password" placeholder="Confirm your password" class="w-full p-2 rounded-lg bg-violet-950 focus:outline-none focus:ring-2 focus:ring-fuchsia-500" required>
            </div>
            <button type="submit" name="submit" class="w-full p-3 mt-4 font-bold text-white bg-black rounded-lg hover:bg-green-600">
                Submit
            </button>
        </form>
    </section>
</body>
</html>

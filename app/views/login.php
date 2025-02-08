<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Login</h2>
        
        <label class="block mt-2 mb-2">Email:</label>
        <input type="email" name="email" required class="w-full p-2 border rounded">
        
        <label class="block mt-2 mb-2">Password:</label>
        <input type="password" name="password" required class="w-full p-2 border rounded">
        <p>
        <?php echo isset($error) ? $error : ""; ?>
        </p>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-600">Submit</button>
    </form>
</body>
</html>

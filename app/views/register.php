<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">User Information</h2>
        
        <label class="block mb-2">Username:</label>
        <input type="text" name="username" required class="w-full p-2 border rounded">
        
        <label class="block mt-2 mb-2">Email:</label>
        <input type="email" name="email" required class="w-full p-2 border rounded">
        
        <label class="block mt-2 mb-2">Password:</label>
        <input type="password" name="password" required class="w-full p-2 border rounded">
        
        <label class="block mt-2 mb-2">Role:</label>
        <select name="role" required class="w-full p-2 border rounded">
            <option value="user">User</option>
            <option value="artiste">Artiste</option>
        </select>
        
        <label class="block mt-2 mb-2">Phone:</label>
        <input type="text" name="phone" required class="w-full p-2 border rounded">
        
        <label class="block mt-2 mb-2">Profile Image:</label>
        <input type="file" name="image" accept="image/*" class="w-full p-2 border rounded">
        
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-600">Submit</button>
    </form>
</body>
</html>

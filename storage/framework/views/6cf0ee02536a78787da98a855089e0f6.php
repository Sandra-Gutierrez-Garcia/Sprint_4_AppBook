<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
  <title>Book App</title>
</head>
<body>
  <nav class="bg-white shadow-sm">
    <div class="flex items-center justify-between p-4">
      <!-- Logo y enlaces "Book" y "Writers" -->
      <div class="flex items-center space-x-4">
        <div class="bg-blue-500 rounded overflow-hidden">
          <img 
            src="/images/logo.jpg" 
            alt="Logo"
            class="h-16 w-auto object-cover" 
          >
        </div>
        <div class="flex space-x-4">
          <a href="<?php echo e(route('book.index')); ?>" 
             class="text-sm text-black hover:bg-orange-300 rounded scale-105 px-4 py-2">Book</a>
          <a href="<?php echo e(route('writer.index')); ?>" 
             class="text-sm text-black hover:bg-orange-300 rounded scale-105 px-4 py-2">Writers</a>
        </div>
      </div>
      <!-- Enlaces de la derecha -->
      <div class="flex space-x-4">
        <a href="<?php echo e(route('writer.create')); ?>" 
           class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Create Writer</a>
        <a href="<?php echo e(route('writer.login')); ?>" 
           class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Login Writer</a>
      </div>
    </div>
  </nav>
    <section class="flex-1 p-8 justify-center items-center">
      <h1 class="text-1xl  text-gray-500 font-bold  text-center">Login Writer</h1>
     <form action="<?php echo e(route('writer.login.process')); ?>" method="POST" class="bg-white p-6 rounded shadow">
  <?php echo csrf_field(); ?>
  <div class="mb-4">
    <label form ="username" class="block text-gray-700">Username</label>
    <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded" value="<?php echo e(old('username')); ?>" required>
  </div>
  <div class="mb-4">
    <label for="password" class="block text-gray-700">Password</label>
    <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
  </div>
 
  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Writer</button>
  <a href="<?php echo e(route('writer.create')); ?>" 
          class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Don't have an account? Sign up!"

</a>
   
</form>

      
</body><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/BookApp/AppBook/resources/views/writer/login.blade.php ENDPATH**/ ?>
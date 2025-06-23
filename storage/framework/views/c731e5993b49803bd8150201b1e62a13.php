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
  <section class="p-6">
   <h1 class="text-1xl  text-gray-500 font-bold  text-start ml-30">Edit Writer</h1>
    
    <form action="<?php echo e(route('writer.update', $writer->idwriter)); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
    <div class="flex items-center justify-center ml-30">
      <div class="flex-1 p-4">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input type="text" name="name" id="name" value="<?php echo e(old('name', $writer->name)); ?>" 
          class=" w-full border border-gray-300 p-2 mb-1 max-w-md text-gray-500 text-start">

          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
          <input type="text" name="username" id="username" value="<?php echo e(old('username', $writer->username)); ?>" 
          class="w-full border border-gray-300 p-2 mb-4 max-w-md text-gray-500 text-start">

         
          <label for="biography" class="block text-sm font-medium text-gray-700 mb-1">Biography</label>
          <textarea name="biography" id="biography" rows="4"
          class="w-full border border-gray-300 p-2 mb-4 max-w-md text-gray-500 text-start min-h-[90px]"><?php echo e(old('biography', $writer->biography)); ?></textarea>
          <div class="mt-2 flex justify-start">

          <button type="submit" class=" hover:bg-orange-300 rounded scale-105 px-4 py-2">
            Change confirmet
          </button>
      </div>
        </div>
        <div class="flex-1 flex flex-col items-center justify-center">
          <?php if($writer->photo): ?>
            <img src="<?php echo e(asset('storage/' . $writer->photo)); ?>" 
            class="w-64 h-64 object-cover rounded-full border-2 border-gray-300 mb-4">
          <?php endif; ?>
          <input type="file" name="photo" class="hidden" id="photoInput">
          <label for="photoInput" class="text-center text-sm mb-2 cursor-pointer">
            Cambiar foto
          </label>
        </div>
            </div>
          s

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/BookApp/AppBook/resources/views/writer/edit.blade.php ENDPATH**/ ?>
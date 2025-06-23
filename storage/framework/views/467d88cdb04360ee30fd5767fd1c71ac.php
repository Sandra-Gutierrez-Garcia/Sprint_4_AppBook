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
  <main class="mx-8">
    <div class="border-2 border-gray-300 my-6 py-8 text-center text-black text-2xl font-bold">
      Bienvenido a la aplicación de libros
    </div>
    <div>
      <h1 class="text-lg font-medium text-gray-600 mb-3">
        BOOK
      </h1>  
       <div>
      <h1 class="text-lg font-medium text-gray-600 mb-3">
        Writer
      </h1>  
      <div class="flex gap-4">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="w-64 h-s rounded-lg flex flex-col items-center justify-center shadow-md shadow-gray-400 bg-white">
            <div class="relative w-32 h-32 overflow-hidden  border-2 border-gray-300 bg-gray-100 flex items-center justify-center">
              <?php if($book->photo): ?>
                <img src="<?php echo e(asset('storage/' . $book->photo)); ?>" alt="book Photo" class="w-32 h-32 object-cover rounded mt-2">
              <?php endif; ?>
            </div>
            <div class="mt-4 text-center w-full">
              <h1 class="block font-semibold"><?php echo e($book->title); ?></h1>
                <p class="text-gray-700"><?php echo e($book->description); ?></p>
                <p class="text-gray-700 text-left">Genres:
                <?php $__currentLoopData = $book->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo e($genre->namegenre); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <p class="text-gray-700 text-left">
                Writer: <?php echo e($book->writer->name); ?>

                </p>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </main>
</body>

  
  </main>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/BookApp/AppBook/resources/views/book/index.blade.php ENDPATH**/ ?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
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
          <a href="{{ route('book.index') }}" 
             class="text-sm text-black hover:bg-orange-300 rounded scale-105 px-4 py-2">Book</a>
          <a href="{{ route('writer.index') }}" 
             class="text-sm text-black hover:bg-orange-300 rounded scale-105 px-4 py-2">Writers</a>
        </div>
      </div>
      <!-- Enlaces de la derecha -->
      <div class="flex space-x-4">
        <a href="{{ route('writer.create') }}" 
           class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Create Writer</a>
        <a href="{{ route('writer.login') }}" 
           class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Login Writer</a>
      </div>
    </div>
  </nav>
    
    <section class="flex-1 p-8 justify-center items-center">
      <h1 class="text-1xl  text-gray-500 font-bold  text-center">Create Writer</h1>
     <form action="{{ route('writer.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded">
  @csrf
  <div class="mb-4">
    <label for="photo" class="block text-gray-500 mt-2">Select Image</label>
    <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border rounded" accept="image/*">
  </div>
  <div class="mb-4">
    <label for="name" class="block text-gray-500 ">Name</label>
    <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded" value="{{ old('name') }}" required>
  </div>
  <div class="mb-4">
    <label form ="username" class="block text-gray-500">Username</label>
    <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded" value="{{ old('username') }}" required>
  </div>
  <div class="mb-4">
    <label for="biography" class="block text-gray-500">Biography</label>
    <textarea name="biography" id="biography" class="w-full px-3 py-2 border rounded" rows="4">{{ old('biography') }}</textarea>
  </div>
  <div class="mb-4">
    <label for="password" class="block text-gray-500">Password</label>
    <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
  </div>
 
  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Writer</button>
    <a href="{{ route('writer.login') }}" 
           class="text-sm text-black-700 hover:bg-orange-300 rounded scale-105 px-4 py-2">Have an account? Log in!</a>
      </div>
</form>
 


    @if(session('success'))
        <div class="mt-4 p-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-4 p-4 bg-red-200 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('message'))
        <div class="mt-4 p-4 bg-blue-200 text-blue-800 rounded">
            {{ session('message') }}
        </div>
    @endif
    </section>
    
</div>

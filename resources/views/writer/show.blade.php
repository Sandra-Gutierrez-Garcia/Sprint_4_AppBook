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

  <section class="p-6">
    <h1 class="text-1xl text-gray-500 font-bold text-start ml-30">Login Writer</h1>
    <div class="flex items-center justify-center ml-30">
      <div class="flex-1 p-4">
        <h3 class="text-sm font-medium text-gray-700 mb-1">Name</h3>
        <p class="border border-gray-300 p-2 mb-1 max-w-xl text-gray-500 text-start">{{$writer->name}}</p>
        
        <h3 class="text-sm font-medium text-gray-700 mt-4 mb-1">Username</h3>
        <p class="border border-gray-300 p-2 mb-1 max-w-xl text-gray-500 text-start">{{$writer->username}}</p>
        
        <h3 class="text-sm font-medium text-gray-700 mt-4 mb-1">Biography</h3>
        <p class="border border-gray-300 p-2 mb-1 text-gray-500 text-start min-h-[90px]">{{$writer->biography}}</p>
        
        <div class="mt-4">
          <a href="{{ route('writer.edit', ['writer' => $writer->idwriter]) }}" class="hover:bg-orange-300 rounded scale-105 px-4 py-2">Edit petfil</a>
        </div> 
      </div>
      
      <div class="flex-1 ml-30">
        @if($writer->photo)
          <img src="{{ asset('storage/' . $writer->photo) }}" alt="Writer Photo" class="w-64 h-64 object-cover rounded mt-2 overflow-hidden rounded-full border-2 border-gray-300 bg-gray-100">
        @endif
      </div>  
    </div>
  </section>

  <section class="p-6 border-t border-gray-200">
    <h1 class="text-1xl text-gray-500 font-bold text-start ml-30 mb-5">Your Book</h1>
    <div class="flex gap-4 ml-30">
      @foreach($writer->books as $book)
      <div class="w-64 rounded-lg flex flex-col justify-center shadow-md shadow-gray-400 bg-white h-62">
        <div class="relative w-full flex justify-center items-center mt-4 mb-2">
          <div class="w-32 h-32 overflow-hidden border-2 border-gray-300 bg-gray-100 flex items-center justify-center">
            @if($book->photo)
              <img src="{{ asset('storage/' . $book->photo) }}" alt="book Photo" class="w-32 h-32 object-cover rounded-full">
            @endif
          </div>
        </div>
        
        <p class="text-sm font-medium text-gray-700 mb-1 text-center">{{ $book->title }}</p>
        
        <div class="flex justify-center border-t border-gray-200">
          <a href="{{ route('book.edit', ['book' => $book->idbook]) }}" class="text-sm text-center hover:bg-orange-300 rounded w-16">edit</a>
          <form action="{{ route('book.destroy', ['book' => $book->idbook]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-center hover:bg-red-300 rounded w-16 ml-2">delete</button>
          </form>
        </div>
      </div>
      @endforeach
      <div>
      <div class="flex justify-center">
        <a href="{{ route('book.create') }}" class="mt-20 px-6 text-gray-700 border border-gray-300 rounded hover:bg-orange-300 transition">
          Create Book
        </a>
      </div>
    </div>
    </div>
    
  </section>
</body>
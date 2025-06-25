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
  <main class="mx-8">
     <!-- Filtar por generos-->
    <div class="p-6 flex justify-center ">
      <form action="{{ route('book.filter') }}" method="GET" class="bg-white p-6 rounded">
        <label class="block text-gray-700 mb-2 text-center">Filter Genre</label>
        <div class="space-x-4">
            @foreach($genres as $genre)
            <label class="inline-flex items-center">
                <input type="checkbox" name="genres[]" value="{{ $genre->idgenre }}" class="form-checkbox">
                <span class="ml-1">{{ $genre->namegenre }}</span>
            </label>
            @endforeach
          <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
        </div>
         </form>

    </div>
    <div class=" border-2 border-gray-300 my-6 py-8 text-center flex justify-center text-black text-2xl font-bold">
      Bienvenido a la aplicación de libros
    </div>
    <div>
      <h1 class="text-lg font-medium text-gray-600 mb-3">
        BOOK
      </h1>  
      <div>
      <div class="p-6 flex gap-4">
        @foreach($books as $book)
          <div class="w-64 h-s rounded-lg flex flex-col items-center justify-center shadow-md shadow-gray-400 bg-white">
            <div class="relative w-32 h-32 overflow-hidden  border-2 border-gray-300 bg-gray-100 flex items-center justify-center">
              @if($book->photo)
                <img src="{{ asset('storage/' . $book->photo) }}" alt="book Photo" class="w-32 h-32 object-cover rounded mt-2">
              @endif
            </div>
            <div class="mt-4 text-center w-full">
              <h1 class="block font-semibold">{{ $book->title }}</h1>
                <p class="text-gray-700">{{ $book->description }}</p>
                <p class="text-gray-700 text-left">Genres:
                @foreach($book->genres as $genre)
                  {{ $genre->namegenre }}
                @endforeach
                </p>
                <p class="text-gray-700 text-left">
                Writer: {{ $book->writer->name }}
                </p>
                <a href="{{ route('book.show', ['book' => $book->idbook]) }}" 
                  class="inline-block mt-2 px-4 py-2  rounded hover:bg-orange-300 h-10">
                  Read
                </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </main>
</body>

  
  </main>
</body>
</html>

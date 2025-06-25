<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Writer;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Genres_book;


  



class BookController extends Controller
{
    public function __construct()
{
    ini_set('log_errors', 1);
    ini_set('error_log', '/Applications/XAMPP/xamppfiles/logs/error_log');
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();// Obtener todos los libros
        $genres_book= Genres_book::all();// obtener sus generos
        $genres = Genre::all(); 
        return view('book.index', ['books' => $books, "genres_book"=>$genres_book, 'genres' => $genres]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        // mira si ha iniciado sesesion
        $writer = session('writer');
        
        //acede los generos
        $genres = Genre::all();
        
        return view('book.create', [
            'writer' => $writer,
            'genres' => $genres
        ]);
    }
    
   
    /**
     * Store a newly created resource in storage.
     */
     public function store(BookRequest $request)
    {
        
        try {
            
            //Obtener el writer de la sesión
            $writer = session('writer');
            
            if (!$writer) {
                return redirect()->route('writer.login')
                    ->with('error', 'Please login first to create a book');
            }

            // Validar los datos
            $validated = $request->validated();
            
            // Agregar el idwriter al array de datos validados
            $validated['idwriter'] = $writer->idwriter;
            $validated['publish_date']= now();


            // Procesar la imagen si existe
            if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('books', 'public');
                $validated['photo'] = $imagePath;
            }
            
            // Crear el libro
            $book = Book::create($validated);
           
            //guardar los generos
            if ($request->has('genres')) {
                $book->genres()->sync($request->genres); // Usar sync en lugar de attach
            }
       
            //dd($book->genres);

       
            error_log("funciona si, se creado correctamnete");
            $writer = $book->idwriter;
            return redirect()->route('writer.show', ['writer' => $writer])
            ->with('Delete book');

            } catch (\Exception $e) {
                    error_log("❌ Error al crear libro: " . $e->getMessage() . " en línea " . $e->getLine());

                return back()
                    ->withInput();
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {           

        try{
        //encontrar el libro por su id
        $book = Book::findOrFail($id);
        // Validar los datos de la solicitud
        $validated = $request->validated();

        //procesar imagen
         if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('books', 'public');
            $validated['photo'] = $imagePath;
        }
        
        $book->update($validated);
        $writer = $book->idwriter;
        return redirect()->route('writer.show', ['writer' => $writer])
        ->with('update correct te book');

        }
        catch (\Exception $e){
                return back()->with('error', 'Failed to update book.');


        }
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::findOrFail($id);
        $book->delete();
        $writer = $book->idwriter;
        return redirect()->route('writer.show', ['writer' => $writer])
        ->with('Delete book');
    }

    public function filterGener(Request $request){
        
        $genres = Genre::all(); 
        $selectedGenres = $request->input('genres', []);
        //solo busque esa informacion
        $query = Book::with(['writer', 'genres']);
        //si ha escogido algun genero activa al if
       if (!empty($selectedGenres)) {
        $query->whereHas('genres', function($q) use ($selectedGenres) {
            $q->whereIn('genre.idgenre', $selectedGenres);
        });

    }
        $books = $query->get();    
        return view('book.index', ['books' => $books,'genres' => $genres, 'selectedGenres' => $selectedGenres]);        
    
    
    }
}

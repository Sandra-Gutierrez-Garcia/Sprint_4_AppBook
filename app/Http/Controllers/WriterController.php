<?php

namespace App\Http\Controllers;
use App\Http\Requests\WriterRequest;
use Illuminate\Http\Request;
use App\Models\Writer;
use App\Models\Book;
use App\Models\Genres_book;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $writers = Writer::all();
        return view('writer.index', ['writers' => $writers]);   
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('/writer/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WriterRequest $request)
    {
        try {
            $validated = $request->validated();

            //process the image if it exists
            if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('writer', 'public');
                $validated['photo'] = $imagePath;
               
            }
            //comprobar si el nombre de usuario ya existe
            $existingWriter = Writer::where('username', $validated['username'])->first();
            if ($existingWriter) {
                return back()
                    ->withInput()
                    ->withErrors(['username' => 'Username already exists.']);
            }

            
            //create the writer
            $writer = Writer::create($validated);

        return redirect()->route('writer.login')

                ->with('success', 'Writer created successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error creating writer: ' . $e->getMessage()]);
        }
    }


    public function loginWriter(){
        
        
        return view('writer.login');

   
    }

    

    // buscar writer por username y password
    public function logeandoWriter (WriterRequest $request){

        //limpiamos ssesiones interiores
            session()->forget('writer');

        try {
            // Validación
            $validated = $request->validated();

            // Buscar al writer
            $writer = Writer::where('username', $request->username)
                        ->where('password', $request->password) 
                        ->first();

            if (!$writer) {
                return back()
                    ->withInput()
                    ->with('error', 'Usuario o contraseña incorrectos');
            }

            // Redirigir con el ID del writer
                session(['writer' => $writer]);           
                return redirect()->route('writer.show', ['writer' => $writer->idwriter])
                ->with('success', 'Inicio de sesión exitoso');

                } catch (\Exception $e) {
                    return back()
                        ->withInput()
                        ->with('error', 'Ocurrió un error: ' . $e->getMessage());
                }
    }
    public function exitWriter(){
        //eliminamos session
        session()->flush();
        return redirect()->route('writer.index')->with('success', 'Exit the session');

        


    }
        
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $writer = Writer::findOrFail($id);
        return view('writer.show', compact('writer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //\Log::info('Session data:', session()->all()); // Registra toda la sesión
        //\Log::info('Editing writer:', ['id' => $id]);

    //$writerId = session('writer'); // Recupera el ID del escritor
    // Verifica coincidencia de IDs
   if (!session('writer')) {
        return redirect()->route('writer.login')->with('error', 'Debes iniciar sesión primero');
    }

    $writer = Writer::findOrFail($id);
    return view('writer.edit', compact('writer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WriterRequest $request, string $id)
    {
        try {
            //buscamos el escritor y actolizamos su perfil
            $writer = Writer::findOrFail($id);
            $validated = $request->validated();

            //procesamos imagen
              if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('writer', 'public');
                $validated['photo'] = $imagePath;
            }
             if ($validated['username'] !== $writer->username) {
            $existingWriter = Writer::where('username', $validated['username'])
                                  ->where('idwriter', '!=', $id)
                                  ->first();
            if ($existingWriter) {
                return back()
                    ->withInput()
                    ->withErrors(['username' => 'Username already exists.']);
            }
        }
            
    
            $writer->update($validated); 


            return redirect()->route('writer.show', ['writer' => $writer->idwriter])
            ->with('success', 'Writer updated successfully!');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to update writer.');
            }
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {
            $writer = Writer::findOrFail($id);
            Book::where('idwriter', $id)->delete();


            //si el atour se elmina, se elimina sus libros con el 
            
            // una vez eliminado sus libros se elimina su perfil de escritor
            $writer->delete();
            session()->flush();

        return redirect()->route('writer.index');
        } catch (\Exception $e) {
            echo 'NO FUNCIONA';
            return back()->with('error', 'Failed to delete writer.');
        }
    }
 
    
    
    
       
 
}

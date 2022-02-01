<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comics = Comic::orderby('id', 'desc')->paginate(7);
        // $comics = Comic::all();
        // $comics = Comic::select('*')->get();
        //dd($comics);
        return view('comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // salvo dentro $data tutti i name dei campi del form inviati nella request
        $data = $request->all();

        // una volta che ho tutti i dati creo un nuovo oggetto Comic
        $new_comic = new Comic();
        
        // gli passo tutti i dati tramite la mia variabile $data
        
        // $new_comic->title = $data['title'];
        // $new_comic->image = $data['image'];
        // $new_comic->price = $data['price'];
        // $new_comic->series = $data['series'];
        // $new_comic->sales_date = $data['sales_date'];
        // $new_comic->type = $data['type'];
        // $new_comic->description = $data['description'];
        // // aggiungo anche lo "slug"
        // $new_comic->slug = Str::slug($new_comic->title , '-');
        // // dd($new_comic);

        // anzichè fare tutti gli associamenti tramite $data (vedi sopra) gli dico di riempire (fill) il mio nuovo oggetto con i campi "necessari" impostati nel Model tramite $fillable
        // ...ma prima definisco lo slug perchè richiesto da $fillable nel Model
        $data['slug'] = Str::slug($data['title'], '-');

        $new_comic->fill($data);

        $new_comic->save();

        // una volta salvato il dato nel DB...
        
        // ...con index si torna all'elenco generale
        // return redirect()->route('comics.index');

        // ...con show si atterra alla pagina di descrizione
        return redirect()->route('comics.show', $new_comic);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $comic = Comic::find($id);
        // dd($comic);

        if($comic){
            return view('comics.show', compact('comic'));
        }
        abort(404, 'Spiacenti, ma il prodotto non è presente nel database');
        
    }

    // public function show(Comic $comic)
    // {
    //     // sostituisco $id con la mia classe Comic
    //     // salvo in una variabile $comic la mia classe
    //     // tolgo il ::find perchè lo fa in automatico se   aggiungo la mia classe in show()
    //     return view('comics.show', compact('comic'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $comic = Comic::find($id);
        // dd($comic);

        if($comic){
            return view('comics.edit', compact('comic'));
        }
        abort(404, 'Spiacenti, ma il prodotto non è presente nel database');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        // da EDIT fatto il submit prendo tutti i dati che arrivano e li salvo 
        $data = $request->all();

        // prendo la mia variabile "comic" e gli aggiorno (update) i vecchi $data con i nuovi $data appena arrivati che verranno ri-salvati nel mio DB
        // ...ma prima definisco lo slug perchè richiesto da $fillable nel Model
        // createSlug() è una funzione privata creata per tenere ordinato il codice
        $data['slug'] = $this->createSlug($data['title']);
        $comic->update($data);

        return redirect()->route('comics.show',compact('comic'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();

        // qui finiamo con un return base
        // return redirect()->route('comics.index');

        // qui dichiariamo e inviamo in sessione con "with" una variabile di sessione "deleted" che ha come valore il messaggio di avvenuta cancellazione
        return redirect()->route('comics.index')->with('deleted', "Il fumetto $comic->title è stato eliminato");
        /* con apici doppi "" possiamo scrivere le variabili php */
        /* con apici singoli '' non si può fare */
    }

    // posso anche aggiungere le mie funzioni personali (private!) per aiutarmi nella stesura del codice
    private function createSlug($string){
        return Str::slug($string, '-');
    }
}

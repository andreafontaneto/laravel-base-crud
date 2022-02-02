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
        // prima di passare i dati si fa la validazione con validate()
        // validate() crea un array associativo...
        // ...con i campi da validare come chiave (prendendo i name degli input)
        //...e delle "regole" impostate da noi (seguendo le migration) come valore
        // con "required" il campo è RICHIESTO quindi finchè non si inseriesce non si passa al campo successivo
        // max e min sono quanti caratteri (massimi e minimi) sono richiesti
        $request->validate(
            // il metodo validate() di request accetta 2 parametri
            // il primo sono tutti i campi da validare...
            [
                'title'=>"required|max:50|min:2",
                // possiamo saltare il controllo di description perchè è nullable()
                // 'description'=>"required|min:5",
                'image'=>"required|max:255",
                'price'=>"required|numeric|max:10|min:1",
                'series'=>"required|max:50|min:2",
                'sales_date'=>"required|max:10",
                'type'=>"required|max:20|min:2"
            ],
            // ...come secondo c'è l'array con i messaggi di errore
            // gli errori sono customizzabili
            [
                // con :max e :min va a leggere il numero di caratteri consentiti

                'title.required'=>'il titolo è obbligatorio',
                'title.max'=>'il titolo deve essere massimo :max caratteri',
                'title.min'=>'il titolo deve essere minimo :min caratteri',

                'image.required'=>'l\'indirizzo dell\'immagine è obbligatorio',
                'image.max'=>'l\'indirizzo dell\'immagine deve essere massimo :max caratteri',

                'price.required'=>'il prezzo è obbligatorio',
                'price.numeric'=>'il prezzo deve essere un numero',
                'price.max'=>'il prezzo deve essere massimo :max caratteri',
                'price.min'=>'il prezzo deve essere minimo :min carattere',

                'series.required'=>'la serie è obbligatoria',
                'series.max'=>'la serie deve essere massimo :max caratteri',
                'series.min'=>'la serie deve essere minimo :min caratteri',

                'sales_date.required'=>'la data di vendita è obbligatoria',
                'sales_date.max'=>'la data di vendita deve essere massimo :max caratteri',

                'type.required'=>'il tipo è obbligatorio',
                'type.max'=>'il tipo deve essere massimo :max caratteri',
                'type.min'=>'il tipo deve essere minimo :min caratteri',

            ]
        );

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
        // prima di aggiornare i dati faccio (ancora) la validazione
        $request->validate(
            // richiamo le MIE funzioni per aiutarmi
            $this->validationData(),
            $this->validationError()
        );

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

    private function validationData(){
        return [
            'title'=>"required|max:50|min:2",
            'image'=>"required|max:255",
            'price'=>"required|numeric|max:10|min:1",
            'series'=>"required|max:50|min:2",
            'sales_date'=>"required|max:10",
            'type'=>"required|max:20|min:2"
        ];
    }

    private function validationError(){
        return [
            'title.required'=>'il titolo è obbligatorio',
            'title.max'=>'il titolo deve essere massimo :max caratteri',
            'title.min'=>'il titolo deve essere minimo :min caratteri',

            'image.required'=>'l\'indirizzo dell\'immagine è obbligatorio',
            'image.max'=>'l\'indirizzo dell\'immagine deve essere massimo :max caratteri',

            'price.required'=>'il prezzo è obbligatorio',
            'price.numeric'=>'il prezzo deve essere un numero',
            'price.max'=>'il prezzo deve essere massimo :max caratteri',
            'price.min'=>'il prezzo deve essere minimo :min carattere',

            'series.required'=>'la serie è obbligatoria',
            'series.max'=>'la serie deve essere massimo :max caratteri',
            'series.min'=>'la serie deve essere minimo :min caratteri',

            'sales_date.required'=>'la data di vendita è obbligatoria',
            'sales_date.max'=>'la data di vendita deve essere massimo :max caratteri',

            'type.required'=>'il tipo è obbligatorio',
            'type.max'=>'il tipo deve essere massimo :max caratteri',
            'type.min'=>'il tipo deve essere minimo :min caratteri',

        ];
    }
}

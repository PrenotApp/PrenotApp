<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateApprovedRequest;
use App\Models\Approved;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        }

        // Recupera l'ID della scuola dell'utente autenticato
        $query = Approved::where('school_id', Auth::user()->school_id);

        // Se è presente un parametro di ricerca, aggiungi il filtro per email
        if ($request->has('search') && $request->search !== '') {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        // Recupera i docenti approvati filtrati
        $approveds = $query->get();

        // Se la richiesta è AJAX, ritorna solo la lista dei docenti filtrata
        if ($request->ajax()) {
            return view('approved.partials.approved-list', compact('approveds'))->render();
        }

        // Se non è una richiesta AJAX, ritorna la vista completa
        return view('approved.index', compact('approveds'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateApprovedRequest $request)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $data = $request->validated();

        $data['school_id'] = Auth::user()->school_id;

        $approved = Approved::create($data);
        $approved->save();

        return redirect()->route('approved.index')->with('success', 'Docente aggiunto con successo.');}
    }

    public function delete(Approved $approved)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {

        // Trova l'utente con la stessa email dell'oggetto `Approved`
        $user = User::where('email', $approved->email)->first();

        // Se esiste un utente con la stessa email, applica una soft delete
        if ($user) {
            $user->delete(); // Soft delete su User
        }

        $approved->delete(); // soft delete

        return redirect()->route('approved.index')->with('success', 'Docente spostato nel cestino.');}
    }

    public function trashed()
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $approveds = Approved::onlyTrashed()->where('school_id', Auth::user()->school_id)
        ->get();
        return view('approved.trashed', compact('approveds'));}
    }

    public function restore($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {

        $approved = Approved::onlyTrashed()->where('id', $id)->firstOrFail();

        $approved->restore();

        // Cerca l'utente corrispondente con la stessa email, anche se è stato cancellato logicamente
        $user = User::onlyTrashed()->where('email', $approved->email)->first();

        // Se l'utente esiste e risulta cancellato logicamente, esegui il ripristino
        if ($user) {
            $user->restore();
        }

        return redirect()->route('approved.trashed')->with('success', 'Docente ripristinato con successo.');}
    }

    public function forceDelete($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {

        $approved = Approved::onlyTrashed()->where('id', $id)->firstOrFail();

        // Cerca l'utente con la stessa email del record Approved
        $user = User::where('email', $approved->email)->first();

        // Esegui la force delete sull'utente se esiste
        if ($user) {
            $user->forceDelete();
        }

        $approved->forceDelete();

        return redirect()->route('approved.trashed')->with('success', 'Docente eliminato definitivamente.');}
    }
}
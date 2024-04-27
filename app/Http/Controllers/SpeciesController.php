<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpeciesRequest;
use App\Http\Resources\SpeciesResource;
use App\Models\Shed;
use App\Models\Species;
use App\Repository\SpeciesRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.species.index',[
            'title' => 'Species'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shed = Shed::all();
        return view('pages.species.create', [
            'title' => 'Species',
            'sheds' => $shed
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpeciesRequest $request)
    {
        SpeciesRepository::save($request->validated());
        return to_route('species.index')->with('alert_s', 'Berhasil menambahkan spesies');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Species $species)
    {
        $sheds = Shed::all(); 
        return view('pages.species.edit', [
            'title' => 'Species',
            'species' => $species,
            'sheds' => $sheds
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpeciesRequest $request, Species $species)
    {
        SpeciesRepository::save($request->validated(), $species);
        return to_route('species.index')->with('alert_s', 'Berhasil mengubah Data Spesies');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Species $species)
    {
        $species->delete();
        return back()->with('alert_s', 'Berhasil menghapus Data Spesies');
    }

    public function dataTables() 
    {
        return datatables(Species::query())
            ->addIndexColumn()
            ->addColumn('action', fn($species) => view('pages.species.action', compact('species')))
            ->toJson();
    }

    public function json()
    {
        $species = Species::all();
        return $this->success(
            SpeciesResource::collection($species),
            'Berhasil mengambil seluruh data'
        );
    }

}

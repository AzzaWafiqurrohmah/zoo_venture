<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShedRequest;
use App\Http\Resources\ShedResource;
use App\Models\Shed;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShedController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.shed.index', [
            'title' => 'Area'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShedRequest $request)
    {
        $shed = Shed::create($request->validated());
        return $this->success(
            ShedResource::make($shed),
            'Berhasil menambahkan Data'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Shed $shed)
    {
        return $this->success(
            ShedResource::make($shed),
            'Berhasil mengambil Data'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShedRequest $request, Shed $shed)
    {
        $shed->update($request->validated());
        return $this->success(
            ShedResource::make($shed),
            'Berhasil mengubah Data'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shed $shed)
    {
        $shed->delete();
        return $this->success(
            message:'Berhasil menghapus data'
        );
    }

    public function dataTables()
    {
        return DataTables(Shed::query())
        ->addIndexColumn()
        ->addColumn('action', fn($shed) => view('pages.shed.action', compact('shed')))
        ->toJson();
    }

    public function json()
    {
        $sheds = Shed::all();
        return $this->success(
            ShedResource::collection($sheds),
            'Berhasil mengambil seluruh Data'
        );
    }
    

}

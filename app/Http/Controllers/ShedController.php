<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShedRequest;
use App\Http\Resources\ShedDetailResource;
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

    public function create()
    {
        return view('pages.shed.create', [
            'title' => 'shed'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShedRequest $request)
    {
        $shed = Shed::create($request->validated());
        return to_route('sheds.index')->with('alert_s', 'Berhasil menambahkan Data Area');
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

    public function edit(Shed $shed)
    {
        return view('pages.shed.edit', [
            'title' => 'Shed',
            'shed' => $shed
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShedRequest $request, Shed $shed)
    {
        $shed->update($request->validated());
        return to_route('sheds.index')->with('alert_s', 'Berhasil mengubah Data Area');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shed $shed)
    {
        $shed->delete();
        return back()->with('alert_s', 'Berhasil menghapus data');
    }

    public function dataTables()
    {
        return DataTables(Shed::query())
            ->addIndexColumn()
            ->addColumn('action', fn ($shed) => view('pages.shed.action', compact('shed')))
            ->toJson();
    }

    public function json()
    {
        $sheds = Shed::all();
        return $this->success(
            ShedDetailResource::collection($sheds),
            'Berhasil mengambil seluruh Data'
        );
    }

    public function apiById(Shed $shed)
    {
        return $this->success(
            ShedResource::make($shed),
            'Berhasil mengambil data'
        );
    }

    public function detailsJson(Request $request)
    {
        $sheds = Shed::whereIn('id', $request->ids)->get();

        return $this->success(
            ShedDetailResource::collection($sheds),
            'Berhasil mengambil seluruh Data'
        );
    }
}

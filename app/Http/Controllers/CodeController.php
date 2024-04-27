<?php

namespace App\Http\Controllers;

use App\Http\Resources\CodeResource;
use App\Models\Code;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CodeController extends Controller
{

    use ApiResponser;

    public function enter(Request $request)
    {
        return view('pages.code.enter', [
            'code' => $request->code ?? '',
        ]);
    }

    public function invalid()
    {
        return view('pages.code.invalid');
    }

    public function index()
    {
        return view('pages.code.index', [
            'title' => 'Kode Tiket',
            'url' => 'https://local?code='
        ]);
    }

    public function store()
    {
        $random = Str::random('6');
        $now = Carbon::now();
        $code = Code::create([
            'code' => $random,
            'expired' => $now->addDay()
        ]);

        return $this->success(
            CodeResource::make($code),
            'Berhasil menambahkan Kode Tiket'
        );
    }

    public function show(Code $code)
    {
        $qrCode = QrCode::size(300)
            ->backgroundColor(255, 255, 255)
            ->color(0, 0, 0)
            ->margin(1)
            ->generate(
                'https://localhost.com?code=ABCDE',
            );
        return $this->success(
            ['qrCode' => $code->code],
            'Berhasil mengambil data'
        );
    }

    public function destroy(Code $code)
    {
        $code->delete();
        return $this->success(
            message: 'Berhasil menghapus Data'
        );
    }

    public function dataTables()
    {
        return datatables(Code::query())
            ->addIndexColumn()
            ->addColumn('action', fn ($code) => view('pages.code.action', compact('code')))
            ->toJson();
    }

    public function json()
    {
        $codes = Code::all();
        return $this->success(
            CodeResource::collection($codes),
            'Berhasil mengambil seluruh data'
        );
    }

    public function generate(Request $request)
    {
        header('Content-Type', 'image/png');

        $url = route('code.enter');

        return QrCode::size(300)
            ->generate("{$url}?code={$request->code}");
    }

    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $code = Code::where('code', $request->code)->first();

        if ($code) {
            Auth::guard('code')->loginUsingId($code->id);
            return to_route('maps.show');
        }

        return to_route('code.invalid');
    }
}

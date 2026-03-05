<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SampleController extends Controller
{
    // ================== ANKOM ==================
    public function ankom()
    {
        $samples = Sample::where('lab_tujuan', 'Ankom')
            ->orderBy('tanggal_masuk', 'asc')
            ->get();

        $labs = ['Ankom', 'Makmin'];
        $title = "📘 Logbook ANKOM";

        return view('samples.index', compact('samples','labs','title'));
    }

    // ================== MAKMIN ==================
    public function makmin()
    {
        $samples = Sample::where('lab_tujuan', 'Makmin')
            ->orderBy('tanggal_masuk', 'asc')
            ->get();

        $labs = ['Ankom', 'Makmin'];
        $title = "📗 Logbook MAKMIN";

        return view('samples.index', compact('samples','labs','title'));
    }

    // ================== SEMUA DATA ==================
    public function index(Request $request)
    {
        $query = Sample::query();

        // SEARCH
        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('nomor_sample','like','%'.$request->search.'%')
                  ->orWhere('nama_sample','like','%'.$request->search.'%');
            });
        }

        // FILTER LAB
        if ($request->lab) {
            $query->where('lab_tujuan', $request->lab);
        }

        $samples = $query->orderBy('tanggal_masuk', 'asc')->get();
        $labs = ['Ankom', 'Makmin'];

        return view('samples.index', compact('samples','labs'));
    }

    // ================== STORE ==================
    public function store(Request $request)
    {
        Sample::create([
            'nomor_sample'   => $request->nomor_sample,
            'nama_sample'    => $request->nama_sample,
            'lab_tujuan'     => $request->lab_tujuan,
            'tanggal_masuk'  => $request->tanggal_masuk,
            'stok'           => $request->stok,
            'status'         => 'Masuk',
        ]);

        return back();
    }

    // ================== EDIT ==================
    public function edit(Sample $sample)
    {
        return view('samples.edit', compact('sample'));
    }

    // ================== UPDATE ==================
    public function update(Request $request, Sample $sample)
    {
        $sample->update([
            'nomor_sample'   => $request->nomor_sample,
            'nama_sample'    => $request->nama_sample,
            'lab_tujuan'     => $request->lab_tujuan,
            'tanggal_masuk'  => $request->tanggal_masuk,
            'stok'           => $request->stok,
        ]);

        return redirect('/');
    }

    // ================== DELETE ==================
    public function destroy(Sample $sample)
    {
        $sample->delete();
        return back();
    }

    // ================== TRASH ==================
    public function trash()
    {
        $samples = Sample::onlyTrashed()
            ->orderBy('tanggal_masuk','asc')
            ->get();

        return view('samples.trash', compact('samples'));
    }

    // ================== RESTORE ==================
    public function restore($id)
    {
        Sample::withTrashed()->find($id)->restore();
        return back();
    }

    // ================== EXPORT PDF ==================
    public function exportPdf(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;

    $samples = Sample::when($bulan, function ($query) use ($bulan) {
            $query->whereMonth('tanggal_masuk', $bulan);
        })
        ->when($tahun, function ($query) use ($tahun) {
            $query->whereYear('tanggal_masuk', $tahun);
        })
        ->orderBy('tanggal_masuk', 'asc')
        ->get();

    $pdf = Pdf::loadView('samples.export_pdf', compact('samples', 'bulan', 'tahun'));

    return $pdf->download('laporan-arsip-preparasi.pdf');
}
}
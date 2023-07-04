<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Donasi;
use App\Models\Donatur;

use App\Models\Invoice;
use Illuminate\Http\Request;

use App\Models\ProgramDonasi;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function showInvoice($id, $user_id)
    //     {
    //         $donatur = Donatur::find($id);

    //         $donasi = DB::table('donasis')
    //             ->join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id')
    //             ->select('donasis.*', 'program_donasis.nama_program')
    //             ->where('donasis.user_id', $user_id) // Filter by user_id
    //             ->get();

    //         $totalDonasi = DB::table('donasis')
    //             ->where('user_id', $user_id)
    //             ->sum('jml_donasi');

    //         $programDonasi = ProgramDonasi::all();
    //         $today = Carbon::now()->format('Y-m-d');
    //         $futureDate = Carbon::now()->addDays(30)->format('Y-m-d');

    //         return view('components.invoice.invoice', compact('futureDate','today','donasi', 'donatur', 'programDonasi', 'totalDonasi'));
    //     }

    public function invoice($id)
        {
            $donatur = Donatur::find($id);

            $donasi = DB::table('donasis')
                ->join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id')
                ->select('donasis.*', 'program_donasis.nama_program')
                ->where('donasis.id_donatur', $id) // Filter by user_id
                ->get();
                $totalDonasi = DB::table('donasis')
                ->where('id_donatur', $id)
                ->sum('jml_donasi');
            $today = Carbon::now()->format('Y-m-d');
            $thirtyDaysAhead = Carbon::now()->addDays(30)->format('Y-m-d');
            return view('components.invoice.invoicezis', compact('donatur', 'donasi', 'today', 'thirtyDaysAhead','totalDonasi'));
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cetakInvoice($id){
        // Retrieve the donor and donation information
        $donatur = Donatur::find($id);
        $donasi = DB::table('donasis')
            ->join('program_donasis', 'donasis.programdonasi_id', '=', 'program_donasis.id')
            ->select('donasis.*', 'program_donasis.nama_program')
            ->where('donasis.donatur_id', $id)
            ->get();

        // Generate the PDF invoice using the Laravel PDF library
        $pdf = PDF::loadView('components.pdf.invoice-pdf', compact('donasi', 'donatur','today'));

        // Set the PDF filename and download it
        return $pdf->download('invoice.pdf');
    }
}

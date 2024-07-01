<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']); //,'store'
        /* $this->middleware('permission:edit-donation|delete-donation', ['only' => ['index','show']]);
        $this->middleware('permission:create-donation', ['only' => ['create','store']]);
        $this->middleware('permission:edit-donation', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-donation', ['only' => ['destroy']]); */
    }

    public function index(): View
    {
        return view('donations.index');
    }

    public function show(): View
    {
        $donations = Donation::with(['user'])
            ->orderByRaw("FIELD(status, 'approved') DESC")
            ->orderBy('requested_date', 'desc')
            ->latest()
            ->paginate(10);

        return view('donations.show', compact('donations'));
        //return view('donations.show');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => ['required'],
            'razon_social' => ['string', 'max:255'],
            'persona_contacto' => ['required', 'string', 'max:255'],
            'email_contacto' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'celular_contacto' => ['required', 'regex:/^(9)[0-9]{8}$/'],
            'info_adicional' => ['string', 'max:255'],
        ]);

        $donation = Donation::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'razon_social' => $request->razon_social,
            'persona_contacto' => $request->persona_contacto,
            'celular_contacto' => $request->celular_contacto,
            'email_contacto' => $request->email_contacto,
            'requested_date' => now(),
            'additional_info' => $request->info_adicional,
        ]);

        if(!$donation){
            return redirect()->route('donations.index')->with('error', 'No se pudo procesar su solicitud. Por favor, intente de nuevo.');
        }

        return redirect()->route('donations.index')->with('success', 'Solicitud procesada con éxito. Nos pondemos en contacto contigo pronto.');
    }

    public function export(Request $request): Response
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();

        $donations = Donation::with(['user'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('requested_date', 'desc')
            ->get();

        $data = ['donations' => $donations, 'startDate' => $startDate, 'endDate' => $endDate];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('donations.export', $data);

        $pdf->render();
        $canvas = $pdf->getCanvas();
        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "Página $pageNumber de $pageCount";
            $font = $fontMetrics->getFont('monospace');
            $pageWidth = $canvas->get_width();
            $pageHeight = $canvas->get_height();
            $size = 10;
            $width = $fontMetrics->getTextWidth($text, $font, $size);
            $canvas->text($pageWidth - $width - 20, $pageHeight - 20, $text, $font, $size);
        });
        return $pdf->stream('Reporte_donaciones_' . $startDate . '_' . $endDate . '.pdf');
        //return view('donations.export', $data);
    }
    public function approve($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->update(['status' => 'approved', 'approved_date' => now()]);
        return back()->with('success', 'Donation approved successfully.');
    }

    public function decline($id)
    {
        $donation = Donation::findOrFail($id);

        $donation->update(['status' => 'rejected']);
        return back()->with('success', 'Donation declined.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(): View
    {
        return view('volunteers.index');
    }

    public function show(): View
    {
        $volunteers = Volunteer::with(['user'])
            ->where('status', '!=', 'inactive')
            ->orderByRaw("FIELD(status, 'approved') DESC")
            ->orderBy('requested_date', 'desc')
            ->latest()
            ->paginate(10);

        return view('volunteers.show', compact('volunteers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf'],
            'info_adicional' => ['string', 'max:255'],
        ]);

        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cvs', 'public');
            $filename = $request->file('cv')->getClientOriginalName();

            $volunteer = Volunteer::create([
                'user_id' => auth()->user()->id,
                'cv_filename' => $filename,
                'cv_path' => $path,
                'additional_info' => $request->info_adicional,
                'requested_date' => now(),
            ]);

            if(!$volunteer){
                return redirect()->route('volunteers.index')->with('error', 'No se pudo procesar su solicitud. Por favor, intente de nuevo.');
            }

            return redirect()->route('volunteers.index')->with('success', 'Solicitud procesada con éxito. Nos pondemos en contacto contigo pronto.');

        } else {
            return redirect()->route('volunteers.index')->with('error', 'Debe proporcionar un CV en PDF.');
        }
    }
    /* public function approve($id): RedirectResponse
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->update(['status' => 'approved', 'approved_date' => now()]);
        return back()->with('success', 'Volunteer approved successfully.');
    }

    public function decline($id): RedirectResponse
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->update(['status' => 'rejected']);
        return back()->with('success', 'Volunteer rejected successfully.');
    }

    public function destroy(Volunteer $volunteer): RedirectResponse
    {
        $volunteer->update(['status' => 'inactive', 'inactive_date' => now()]);
        return back()->with('success', 'Volunteer inactive.');
    } */
}

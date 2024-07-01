<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(): View
    {
        $user = Auth::user();
        $existingRequest = null;

        if ($user) {
            $existingRequest = Volunteer::where('user_id', $user->id)->first();
        }

        return view('volunteers.index', compact('existingRequest'));
    }

    public function show(): View
    {
        $volunteers = Volunteer::with(['user'])
            ->orderByRaw("FIELD(status, 'active', 'pending', 'inactive') ASC")
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

    public function approve($id): RedirectResponse
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'active';
        $volunteer->approved_date = now();
        $volunteer->save();

        $user = $volunteer->user;
        $user->assignRole('Volunteer');

        return redirect()->route('volunteers.show')->with('success', 'Voluntario aprobado con éxito.');
    }

    public function decline($id): RedirectResponse
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'inactive';
        $volunteer->inactive_date = now();
        $volunteer->save();

        $user = $volunteer->user;
        $user->removeRole('Volunteer');

        return redirect()->route('volunteers.show')->with('success', 'Voluntario rechazado con éxito.');
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

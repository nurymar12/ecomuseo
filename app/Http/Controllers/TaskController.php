<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use App\Models\Task;
use App\Models\Volunteer;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware('permission:create-task|edit-task|delete-task', ['only' => ['index','show','download']]);
        $this->middleware('permission:create-task', ['only' => ['create','store']]);
        $this->middleware('permission:edit-task', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-task', ['only' => ['destroy']]); */
    }

    public function index(): View
    {
        $tasks = Task::with('volunteers')
            ->where('status', '!=', 'inactive')
            ->orderBy('created_at', 'desc')
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $volunteers = Volunteer::with(['user'])
            ->where('status', 'active')->get();

        return view('tasks.create', compact('volunteers'));
    }

    public function show(Task $task): View
    {
        $task = Task::findOrFail($task->id);
        return view('tasks.show', compact('task'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string|max:255',
            'type' => 'required',
            'volunteer_id' => 'required'
        ]);

        $newTask = Task::create([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type
        ]);

        $taskId = $newTask->id;

        $volunteerId = $request->input('volunteer_id');

        $newTask->volunteers()->attach($volunteerId, ['assigned_date' => now()]);

        return redirect()->route('tasks.index')->withSuccess('Tarea creada con éxito.');
    }

    public function edit(Task $task): View
    {
        $volunteers = Volunteer::with(['user'])
            ->where('status', 'active')->get();

        $task = Task::findOrFail($task->id);

        $volunteerId = $task->volunteers->first()->pivot->volunteer_id;

        return view('tasks.edit', compact(['task', 'volunteers', 'volunteerId']));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:250',
            'content' => 'required|string|max:255',
            'type' => 'required',
            'volunteer_id' => 'required'
        ]);

        $task->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => $data['type']
        ]);

        $task->volunteers()->sync([
            $data['volunteer_id'] => ['assigned_date' => now()],
        ]);

        return redirect()->route('tasks.index')->withSuccess('Tarea actualizada con éxito.');
    }

    public function export(Request $request): Response
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();

        $tasks = Task::with(['volunteers' => function ($query) {
            $query->select('volunteers.id', 'volunteers.user_id');
        }])
            ->where('tasks.status', '!=', 'inactive')
            ->whereDate('tasks.created_at', '>=', $startDate)
            ->whereDate('tasks.created_at', '<=', $endDate)
            ->select('tasks.id','tasks.type','tasks.title','tasks.content','tasks.status','tasks.created_at')
            ->orderBy('tasks.created_at', 'desc')
            ->get();

        $data = ['tasks' => $tasks, 'startDate' => $startDate, 'endDate' => $endDate];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('tasks.export', $data);

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
        return $pdf->stream('Reporte_tareas_' . $startDate . '_' . $endDate . '.pdf');
        //return $pdf->download('reporteTareas.pdf');
        //return view('tasks.export', $data);
    }

    public function complete(Task $task): RedirectResponse
    {
        $task = Task::findOrFail($task->id);

        $assignedDate = $task->volunteers->first()->pivot->assigned_date;

        $volunteerId = $task->volunteers->first()->pivot->volunteer_id;

        $task->volunteers()->sync([
            $volunteerId => ['status' => 'completed', 'completed_date' => now(), 'assigned_date' => $assignedDate],
        ]);

        return back();
        //return redirect()->route('home')->withSuccess('success', 'Task completed successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->update(['status' => 'inactive']);
        $task->volunteers->first()->pivot->update(['status' => 'cancelled']);

        return redirect()->route('tasks.index')->withSuccess('Tarea cancelada.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use http\Message;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('categories', 'labels', 'priority', 'status', 'messages')
            ->when(auth()->user()->hasRole('user'), function ($query){
                $query->where('user_id', auth()->user()->id);
            })
            ->when(auth()->user()->hasRole('agent'), function ($query){
                $query->where('assigned_to', auth()->user()->id);
            })
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $labels = Label::all();
        $categories = Category::all();
        $priorities = Priority::all();

        return view('tickets.create', compact('labels', 'categories', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = auth()->user()->tickets()->create($request->only('title', 'message'));

        $ticket->categories()->sync($request->input('categories'));

        $ticket->labels()->sync($request->input('labels'));

        $ticket->priority()->associate($request->input('priority_id'));

        $ticket->status()->associate(1);

        $ticket->save();

        return to_route('tickets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $statuses = Status::all();

        return view('tickets.show', compact('ticket', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        return to_route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        return to_route('tickets.index');
    }

    public function changeStatus(Request $request, Ticket $ticket)
    {
        $ticket->status()->associate($request->input('status'));
        $ticket->save();

        return back();
    }

    public function addMessage(Request $request, Ticket $ticket)
    {
        $message = auth()->user()->messages()->create($request->only('message'));

        $message->ticket()->associate($ticket);

        $message->save();

        return back();
    }
}

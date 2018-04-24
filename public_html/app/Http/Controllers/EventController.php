<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\UpdateEvent;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    /**
     * Show the events create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Show the events edit page.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = \Auth::user()->events()->findOrFail($id);

        return view('events.edit', compact('event'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /*
         *  Process Ajax request
        */

        if ($request->ajax()) {
            $events_start = Carbon::parse($request->start)->format('Y-m-d');
            $events_end = Carbon::parse($request->end)->format('Y-m-d');
            $events = \Auth::user()->events()->whereBetween('date', array($events_start, $events_end))->get();

            return $events;
        }

        /*
         *  Process regular HTTP request
        */

        $events = \Auth::user()->events()->get()->sortBy(function ($event) {
            return Carbon::createFromFormat('d/m/Y', $event['date'])->getTimestamp();
        });

        return view('events.index', compact('events'));
    }

    /**
     * Store the event in the database.
     *
     */
    public function store(StoreEvent $request)
    {

        $event = \Auth::user()->events()->create($request->all());

        if ($event instanceof Event) {
            session()->flash('success', "Event '$event->title' successfully created.");
        } else {
            session()->flash('fail', "Event failed to create.");
        }

        return redirect()->route('events.index');

    }

    /**
     * Update an event in the database.
     *
     */
    public function update(UpdateEvent $request, $id)
    {

        $event = \Auth::user()->events()->find($id);

        if ($event->update($request->all())) {
            session()->flash('success', "Event '$event->title' successfully updated.");
        } else {
            session()->flash('fail', "Event failed to update.");
        }

        return redirect()->route('events.index');

    }

    /**
     * Delete an event in the database.
     *
     */
    public function destroy($id)
    {

        $event = \Auth::user()->events()->find($id);

        if ($event->delete()) {
            session()->flash('success', "Event '$event->title' successfully deleted.");
        } else {
            session()->flash('fail', "Event failed to delete.");
        }

        return redirect()->route('events.index');

    }
}

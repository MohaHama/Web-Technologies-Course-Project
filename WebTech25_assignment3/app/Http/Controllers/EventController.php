<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    /* Method that runs when we go to index blade */
    public function index()
    {
        /* we use static method all to store all events into variable events */
        /* We then return the view index and giving the blade acces to index array*/
        $events = Event::all();
        return view('index', ['events' => $events]);
    }
    public function create(Request $request)
    {
        //validating request data so every input from the form is correct!
        $data = $request->validate([ // uses the method to connect to authenticated user that created the event
            'event' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required',
            'price' => 'required|decimal:0,4',
            'available_seats' => 'required|numeric'
        ]);

        //Get the id from the authenticated user that is creating this event
        $data['host_id'] = auth()->id();
        //Here we make a new varaible and use a static method from Product model class and use the create() method to store $data from before into the database
        Event::create($data);

        //after everything is done, retur the user back to "product.index" blade/page
        return redirect(route('event.index'))->with('succes', "Entity added Succesfully");
    }


    /* Delete method */
    public function delete($id)
    {
        /* findOrFail() retrieves a ressource by its ID or throws a 404 error if it doesnt exist in the db */
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect(route('event.index'))->with('succes', "Entity deleted successfully");
    }

    /* Edit / update mryhofds*/
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('update', ['event' => $event]);
    }

    public function update($id, Request $request)
    {
        //validating request data so every input from the form is correct!
        $data = $request->validate([
            'host' => 'required',
            'event' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required',
            'price' => 'required|decimal:0,4',
            'available_seats' => 'required|numeric'
        ]);

        $event = Event::findOrFail($id);
        $event->update($data);

        //after everything is done, retur the user back to "product.index" blade/page. With a succes mesaage aswell
        return redirect(route('event.index'))->with('succes', "Entity updated Succesfully");
    }

    /* Show method for specific ressource */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('show', ['event' => $event]);
    }

    /* method to direct create view */
    public function showCreate()
    {
        return view('create');
    }
}

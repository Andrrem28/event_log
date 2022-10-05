<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class EventController extends Controller
{
    public function index()
    {

        $search = request('search');

            if($search)
             {
                $events = Event::where([
                    ['title', 'like', '%'.$search.'%']
                ])->get();

            } else {
                $events = Event::all();

          }
            return view('welcome', [
                'events' => $events,
                 'search' => $search
                ]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
             $event = new Event;

             $event->title = $request->title;
             $event->city = $request->city;
             $event->private = $request->private;
             $event->description = $request->description;
             $event->items = $request->items;
             $event->date = $request->date;


        // Image Upload

            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $request->image->move(public_path('img/events'), $imageName);
                $event->image = $imageName;
            }

            $event->save();
                DB::commit();
                return redirect('/')->with('msg', 'Evento criado com sucesso');

        } catch (Exception $e) {
                DB::rollBack();

                return redirect('events.create')->with('msg-error', 'Erro ao criar evento');
        }


    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', ['event' =>$event]);
    }
}

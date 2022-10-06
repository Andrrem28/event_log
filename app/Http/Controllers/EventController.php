<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, User};
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


            $user = auth()->user();
            $event->user_id = $user->id;

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

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show',
        [
            'event' =>$event,
            'eventOwner' => $eventOwner
        ]);
    }

    public function edit($id)
    {
      $event = Event::findOrFail($id);

      return view('events.edit',
      [
        'event' => $event
      ]);

    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            // Image Upload

            if(
                $request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $request->image->move(public_path('img/events'), $imageName);
                $data['image'] = $imageName;
            }

            Event::findOrFail($request->id)->update($data);

            DB::commit();

            return redirect('/dashboard')->with('msg', 'Evento atualizado com sucesso');

        } catch(Exception $e){
            dd($request);
            DB::rollBack();
        }

    }

    public function destroy(int $id)
    {
        DB::beginTransaction();

        try {
            Event::findOrFail($id)
            ->delete();

            DB::commit();
            return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
        }

        catch(Exception $e){
            DB::rollBack();

        }
    }

    public function dashboard()
    {
            $user = auth()->user();

            $events = $user->events;


            return view('events.dashboard',
            [
                'events' => $events
            ]);
    }
}

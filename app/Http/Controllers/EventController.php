<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\IndexRequest;
use App\Http\Requests\Events\StoreRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $limit = isset($validated['limit']) && !is_null($validated['limit']) ? $validated['limit'] : 15;
        $start = isset($validated['start']) && !is_null($validated['start']) ? $validated['start'] : \Carbon\Carbon::now();

        $events = Event::startsAfterOrEqual($start)->orderBy('starts_at', 'ASC')->limit($limit)->get();

        return [
            'data' => EventResource::collection($events)
            ->collection->groupBy(function ($item, $key) {
                return substr($item['starts_at'], 0, -9);
            }),
            'metadata' => [
                'total' => 20,
                'current_date' => '2020/03/20',
                'next_date' => '2020/10/29',
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $event = new Event();
        $event->title = $validated['title'];
        $event->is_all_day = $validated['is_all_day'];
        $event->starts_at = $validated['starts_at'];
        $event->ends_at = $validated['ends_at'];
        $event->notes = $validated['notes'];
        $event->save(); 

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

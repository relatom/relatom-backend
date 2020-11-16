<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\StoreRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\ParticipantResource;
use App\Http\Resources\ParticipationResource;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::startsAfterOrEqualNow()->orderBy('starts_at', 'ASC')->get();

        return EventResource::collection($events)
            ->collection->groupBy(function ($item, $key) {
                return substr($item['starts_at'], 0, -9);
            });
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
    public function update(StoreRequest $request, Event $event)
    {
        $validated = $request->validated();

        $event->title = $validated['title'];
        $event->is_all_day = $validated['is_all_day'];
        $event->starts_at = $validated['starts_at'];
        $event->ends_at = $validated['ends_at'];
        $event->notes = $validated['notes'];
        $event->save(); 

        return new EventResource($event);
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

    public function getComments(Event $event)
    {
        return CommentResource::collection($event->comments()->orderBy('created_at', 'DESC')->get());
    }

    public function storeComment(Request $request, Event $event)
    {

        $comment = $event->comments()->create([
            'message' => $request->message,
            'member_id' => $request->user()->member->id
        ]);

        return new CommentResource($comment); 
    }

    public function getParticipants(Event $event)
    {
        return ParticipantResource::collection($event->participants()->orderBy('created_at', 'ASC')->get());
    }

    public function getParticipations(Request $request, Event $event)
    {
        
        $member = $request->user()->member;
        // Format user participation 
        // Trouver s'il à déjà une participation si cas rajouter is_participating == true
        $member_participation = $event->participants()->where('member_id', $member->id)->first();
        $member->is_participating = $member_participation != null;

        $result = [$member];

        // Add children if there is
        $children = $member->children;
        if(count($children) > 0) {
            $children_participation = $event->participants()->where('parent_id', $member->id)->get();
            foreach ($children as $child) {
                $child->is_participating = false;
                foreach ($children_participation as $participation) {
                    if($child->id == $participation->id) {
                        $child->is_participating = true;
                    }
                }
                array_push($result, $child);
            }
        }
        
        return ParticipationResource::collection(collect($result));
    }

    public function storeParticipations(Request $request, Event $event)
    {
        $participation = Member::findByHashidOrFail($request->id);
        $event->participants()->toggle([$participation->id]);
        
        return ParticipantResource::collection($event->participants()->orderBy('created_at', 'ASC')->get());
    }
}
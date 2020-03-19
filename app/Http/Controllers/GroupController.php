<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Group;
use App\Http\Requests\Groups\AddContactsRequest;
use App\Http\Requests\Groups\StoreGroupRequest;
use Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Auth::user()->groups()->latest()->get();

        return view('groups.index', compact("groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts = Auth::user()->contacts;

        return view('groups.create', compact("contacts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Groups\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $group = new Group;
        $group->user()->associate(Auth::user());
        $group->name = $request->name;
        $group->save();

        $group->contacts()->attach($request->contacts);

        return redirect()->route('groups.index')->with('success', 'The group was created');
    }

    public function addContacts(AddContactsRequest $request)
    {
        $group = Group::find($request->group);

        $group->contacts()->attach($request->contacts);

        return redirect()->route('groups.index')->with('success', 'The contacts were added');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        $contacts = Auth::user()->contacts;

        return view('groups.edit', compact("group", "contacts"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $group->name = $request->name;
        $group->save();

        $group->contacts()->sync($request->contacts);

        return redirect()->route('groups.index')->with('success', 'The group was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $this->authorize('delete', $group);

        if ($group->delete()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'The group was deleted'
                ]);
            }

            return redirect()->back()->with('success', 'The group was deleted');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'There was a problem deleting the group'
            ]);
        }

        return redirect()->back()->with('error', 'There was a problem deleting the group');
    }

    /**
     * Remove multiple specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyMultiple(Request $request)
    {
        $groups = Group::whereIn('id', $request->groups)->get();

        $this->authorize('delete', $groups);

        if (Group::whereIn('id', $request->groups)->delete()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Групите бяха изтрити'
                ]);
            }

            return redirect()->back()->with('success', 'Групите бяха изтрити');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Възникна проблем с изтриването на групите'
            ]);
        }

        return redirect()->back()->with('error', 'Възникна проблем с изтриването на групите');
    }

    public function getContacts(Group $group)
    {
        return response()->json($group->contacts);
    }
}

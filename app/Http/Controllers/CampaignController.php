<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignStatus;
use App\CampaignTemplate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    //Hasing function for the image name
    private function hashImageName($image)
    {
        return md5($image->getClientOriginalName() . uniqid('weband')) . '.' . $image->getClientOriginalExtension();
    }

    /**
     * CampaignController constructor.
     */
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
        $campaigns = Auth::user()->campaigns;
        $statuses = CampaignStatus::all();

        return view('campaigns.index', compact("campaigns", "statuses"));
    }

    public function getCampaigns()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = CampaignTemplate::all();
        $contacts = Auth::user()->contacts;
        $groups = Auth::user()->groups;

        return view('campaigns.create', compact("templates", "groups", "contacts"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = CampaignStatus::where('alias', 'sent')->first();

        $campaign = new Campaign;
        $campaign->user()->associate(Auth::user());
        $campaign->name = $request->name;
        $campaign->from = $request->from;
        $campaign->subject = $request->subject;
        $campaign->template()->associate($request->template);
        $campaign->status()->associate($status);
        $campaign->title = $request->title;
        $campaign->text = $request->text;
        $campaign->button_text = $request->button_text;
        $campaign->button_color = $request->button_color;

        //Check if image is presented in the request and it's valid
        if($request->hasFile('logo') && $request->logo->isValid()) {
            $logo = $request->logo;
            $image_name = $this->hashImageName($logo);

            //store the image in the filesystem
            Storage::disk('local')->putFileAs('logos', $logo, $image_name);

            //store the path as text in the database
            $campaign->logo = $image_name;
        }

        $campaign->save();

        $campaign->contacts()->attach($request->contacts);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Кампанията беше създадена успешно.', 'redirect' => route('campaigns.index')]);
        }

        return redirect()->route('campaigns.index')->with('success', 'Кампанията беше създадена успешно.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $templates = CampaignTemplate::all();
        $contacts = Auth::user()->contacts;
        $groups = Auth::user()->groups;

        return view('campaigns.edit', compact("campaign", "templates", "contacts", "groups"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $campaign->name = $request->name;
        $campaign->from = $request->from;
        $campaign->subject = $request->subject;
        $campaign->template()->associate($request->template);
        $campaign->title = $request->title;
        $campaign->text = $request->text;
        $campaign->button_text = $request->button_text;
        $campaign->button_color = $request->button_color;

        //Check if image is presented in the request and it's valid
        if($request->hasFile('logo') && $request->logo->isValid()) {
            $logo = $request->logo;
            $image_name = $this->hashImageName($logo);

            //store the image in the filesystem
            Storage::disk('local')->putFileAs('logos', $logo, $image_name);

            $campaign->deleteLogo();

            //store the path as text in the database
            $campaign->logo = $image_name;
        }

        $campaign->save();

        $campaign->contacts()->sync($request->contacts);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Кампанията беше редактирана успешно.', 'redirect' => route('campaigns.index')]);
        }

        return redirect()->route('campaigns.index')->with('success', 'Кампанията беше създадена успешно.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->deleteLogo();
        $campaign->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Кампанията беше изтрита']);
        }

        return redirect()->back()->with('success', 'Кампанията беше изтрита');
    }
}

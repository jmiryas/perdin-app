<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\TravelStatus;
use Illuminate\Http\Request;

class SdmTravelController extends Controller
{
    public function index()
    {
        $travel_status_pending = TravelStatus::where("name", "Pending")->first();

        $travels = Travel::where("div_sdm_id", auth()->user()->id)
            ->where("travel_status_id", $travel_status_pending->id)
            ->with(["travelStatus", "currentCity", "destinationCity"])
            ->orderBy("travel_status_id")->get();

        return view("sdm_travels.index", compact("travels"));
    }

    public function travelHistories()
    {
        $travel_status_pending = TravelStatus::where("name", "Pending")->first();

        $travels = Travel::where("div_sdm_id", auth()->user()->id)
            ->where("travel_status_id", "!=", $travel_status_pending->id)
            ->with(["travelStatus", "currentCity", "destinationCity"])
            ->orderBy("travel_status_id")->get();

        return view("sdm_travels.histories", compact("travels"));
    }

    public function show(Travel $travel)
    {
        return view("sdm_travels.show", ["travel" => $travel]);
    }

    public function rejectTravel(Request $request)
    {
        $this->validate($request, [
            "travel_id" => "required|exists:travel,id"
        ]);

        $travel = Travel::where("id", $request->travel_id)->first();

        $travel_status_rejected = TravelStatus::where("name", "Rejected")->first();

        $travel->update([
            "travel_status_id" => $travel_status_rejected->id
        ]);

        return redirect(route("sdm.travels.index"))->with("success", "Perdin berhasil ditolak");
    }

    public function acceptTravel(Request $request)
    {
        $this->validate($request, [
            "travel_id" => "required|exists:travel,id"
        ]);

        $travel = Travel::where("id", $request->travel_id)->first();

        $travel_status_accepted = TravelStatus::where("name", "Accepted")->first();

        $travel->update([
            "travel_status_id" => $travel_status_accepted->id
        ]);

        return redirect(route("sdm.travels.index"))->with("success", "Perdin berhasil disetujui");
    }
}

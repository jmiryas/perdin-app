<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\TravelStatus;
use Illuminate\Http\Request;

class AdminTravelController extends Controller
{
    public function index()
    {
        $travels = Travel::with(["travelStatus", "currentCity", "destinationCity"])->orderBy("travel_status_id")->get();

        return view("admin_travels.index", compact("travels"));
    }

    public function show(Travel $travel)
    {
        return view("admin_travels.show", ["travel" => $travel]);
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

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil ditolak");
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

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil disetujui");
    }

    public function destroy(Travel $travel)
    {
        $travel->delete();

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil dihapus");
    }
}

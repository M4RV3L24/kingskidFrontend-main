<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Donation;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Views Related
    public function index()
    {
        $events = Event::where('active', 1)
            ->whereNotNull('image')
            ->orWhereNotNull('gallery')
            ->latest()
            ->get();
            
        return view('user.home', compact('events'));
    }

    public function donate()
    {
        $events = Event::query()->where('active', 1)->get();
        return view('user.donation', ['events' => $events]);
    }

    public function thankyou()
    {
        return view('user.thankyou');
    }

    public function showDonationById()
    {
        $user_id = auth()->user()->id;
        $donations = Donation::query()->where('user_id', $user_id)->where('active', 1)->get();
        // Calculate the total amount of all donations
        $totalAmount = $donations->sum('nominal');
        return view('user.list', [
            'donations' => $donations,
            'totalAmount' => $totalAmount
        ]);
    }
    
    // Donation Related
    public function addDonation(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'email' => 'required|email',
            'name' => 'required',
            'nominal' => 'required|numeric',
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'event_id' => 'required|exists:events,id',
        ]);
        try{
            //check anonimous or not
            if ($request->has('anonymous') && $request->anonymous == '1') {
                $validated['name'] = 'Anonim';
            }

            // make sure file name is unique
            $file = $request->file('proof');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;

            $validated['proof'] = $file->storeAs('bukti', $fileNameToStore, 'public');
            Donation::create($validated);
        } catch (\Throwable $th) {
            return redirect()->route('user.donate')->with('error', $th->getMessage() );
        }

        return redirect()->route('user.thankyou');
    }
}
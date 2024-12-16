<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\PaypalPayment;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AdminController extends Controller
{
    public function showDonation()
    {
        $donations = Donation::query()->where('active', 1)->get();
        // Calculate the total amount of all donations
        $totalAmount = $donations->sum('nominal');

        return view(
            'admin.dashboard',
            [
                'donations' => $donations,
                'totalAmount' => $totalAmount,
            ]
        );
    }

    public function indexLogs()
    {
        //show all deleted donations with active = 0
        $donations = Donation::query()->where('active', 0)->get();
        return view('admin.logs', ['donations' => $donations]);
    }

    public function settings()
    {
        return view('admin.settings');
    }

    // Donation Related
    public function deleteDonation(Request $request)
    {
        $id = $request->id;

        try {
            $donation = Donation::find($id);
            $donation->active = 0;
            $donation->save();
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to delete donation');

        }
        return redirect()->route('admin.dashboard')->with('success', 'Donation deleted successfully');
    }

    public function restoreDonation(Request $request)
    {
        $id = $request->id;

        try {
            $donation = Donation::find($id);
            $donation->active = 1;
            $donation->save();
        } catch (\Throwable $th) {
            return redirect()->route('admin.logs')->with('error', 'Failed to restore donation');
        }
        return redirect()->route('admin.logs')->with('success', 'Donation restored successfully');
    }

    public function trashDonation(Request $request)
    {
        $id = $request->id;

        try {
            $donation = Donation::find($id);
            //delete the image
            $imagePath = public_path('storage/' . $donation->proof);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $donation->delete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.logs')->with('error', 'Failed to remove donation');
        }
        return redirect()->route('admin.logs')->with('success', 'Donation remove successfully');
    }


    public function newAdmin (Request $request){
        $validated = $request->validate([
            // 'name' => 'required',
            'email' => 'required|email',
        ]);
        try{
            $newAdmin = User::create([
                'name' => 'Admin',
                'email' => $validated['email'],
                'google_id' => null,
                'role' => 'admin',
            ]);
            return redirect()->route('admin.settings')->with('success', 'New admin added successfully');
        }catch(\Throwable $th){
            return redirect()->route('admin.settings')->with('error', 'Failed to add new admin');
        }
    }


}

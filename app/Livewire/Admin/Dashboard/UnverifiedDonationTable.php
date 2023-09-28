<?php

namespace App\Livewire\Dashboard;
use App\Models\InstantRecord;
use App\Models\User;

use Livewire\Component;

class UnverifiedDonationTable extends Component
{

        public $unverifiedDonations = InstantRecord::orderBy('updated_at', 'DESC')->get()
                               ->where('year', '=', getCurrentYear())
                               ->where('transaction', '=', 1)
                               ->where('payment_status', '=', 1)
                               ->where('verification', '=', '0');
        public $recorder = User::all();

    public function render()
    {
        return view('livewire.admin.dashboard.unverified-donation-table', compact('unverifiedDonations'), compact('recorder') );
    }
}

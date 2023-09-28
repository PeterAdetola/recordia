<?php

namespace App\Livewire\Admin\Records\Modals;

use Livewire\Component;
use App\Models\InstantRecord;

class AddDonationForm extends Component
{

public $modalOpen = false;

    #[Rule('required')]
    public $name = '';
    #[Rule('required')]
    public $recorder_id = '';
    public $phone;
    #[Rule('required')]
    public $purpose = '';
    #[Rule('required')]
    public $amount = '';
    #[Rule('required')]
    public $transaction = '';
    #[Rule('required')]
    public $payment_mode = '';
    #[Rule('required')]
    public $payment_status = '';
    #[Rule('required')]
    public $verification = '';
    #[Rule('required')]
    public $year = '';


    public function saveDonation()
    {

    /**
     * Cash     (payment_mode = 1)
     * POS      (payment_mode = 2)
     * Transfer (payment_mode = 3)
     * Pledge   (payment_mode = 4)
     */

        // Set verification and payment_status based on payment_mode
        $this->verification = 0;
        $this->payment_status = 0;
        $this->transaction = 1;
        $this->recorder_id = getCurrentUser();
        $this->year = getCurrentYear();

        switch ($this->payment_mode) {
            case 1: // Cash
            case 2: // POS
                $this->verification = 1;
                $this->payment_status = 1;
                break;
            case 3: // Transfer
                $this->verification = 0;
                $this->payment_status = 1;
                break;
            case 4: // Pledge
                $this->verification = 0;
                $this->payment_status = 0;
                break;
        }

        // Sanitize amount to numbers only
        $amount = filter_var($this->amount, FILTER_SANITIZE_NUMBER_INT);
        $amount = intval($amount);

        // echo ($this->verification);
        // exit;

       InstantRecord::create([
            'recorder_id' => $this->recorder_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'purpose' => $this->purpose,
            'transaction' => $this->transaction,
            'amount' => $amount,
            'payment_mode' => $this->payment_mode,
            'payment_status' => $this->payment_status,
            'verification' => $this->verification,
            'year' => $this->year,
        ]);

        $this->modalOpen = false;
        $this->dispatch('addDonation');
        
        $this->reset();
        // $this->dispatch('toast', ['message' => 'Donation added']);
        session()->flash('message', 'Donation saved');
    }

    public function render()
    {
        return view('livewire.admin.records.modals.add-donation-form');
    }
}

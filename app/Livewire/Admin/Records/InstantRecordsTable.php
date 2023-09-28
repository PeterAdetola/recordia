<?php

namespace App\Livewire\Admin\Records;

use Livewire\Component;
use App\Models\InstantRecord;

class InstantRecordsTable extends Component
{
    public $instantRecords;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->instantRecords = InstantRecord::orderBy('updated_at', 'DESC')
            ->where('year', '=', getCurrentYear())
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.records.instant-records-table');
    }

    protected $listeners = ['addDonation'];

    public function addDonation()
    {
        $this->loadData();
    }
}
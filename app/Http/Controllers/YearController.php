<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YearRecord;

class YearController extends Controller
{
    /**
     * Path to create year, event, and more.
     */
    public function manageYear(Request $request)
    {
        $tab = '';
        $existing_years = YearRecord::orderBy('year', 'desc')->get();

        return view('admin.configs.config_year', compact('tab', 'existing_years'));
    }

    /**
     * Save the created year.
     */
    public function saveYear(Request $request)
    {
        $this->validateYear($request);

        if (!$this->yearExists($request->year)) {
            $this->createYear($request);
            return $this->redirectWithNotification('New year created', 'Congratulations, new year created!', 'Select the created year to activate it for financial activities and records.');
        }

        return $this->redirectWithNotification('Year already exists');
    }

    /**
     * Activate selected year.
     */
    public function activateYear(Request $request)
    {
        $selectedYearId = $request->input('status');

        if ($this->isYearAlreadyActive($selectedYearId)) {
            return $this->redirectWithNotification('Nothing to activate');
        }

        $this->activateSelectedYear($selectedYearId);

        return $this->redirectWithNotification(
            'Year ' . getCurrentYear() . ' is activated',
            'Congratulations, year ' . getCurrentYear() . ' is activated!',
            'All activities will be done to the year ' . getCurrentYear() . ' and records for the year will be displayed if it exists.'
        );
    }

    /**
     * Update year details.
     */
    public function updateYear(Request $request)
    {
        $this->setSessionTab($request->tab);

        YearRecord::findOrFail($request->id)->update([
            'year' => $request->year,
            'title' => $request->title,
        ]);

        return $this->redirectWithNotification('Year details updated');
    }

    /**
     *
     *
     * Private methods
     */

    private function validateYear(Request $request)
    {
        $request->validate([
            'year' => 'required|date_format:Y',
        ], [
            'year.required' => 'Please enter the year according to the stated format',
        ]);
    }

    private function yearExists($year)
    {
        return YearRecord::where('year', $year)->exists();
    }

    private function createYear(Request $request)
    {
        $this->setSessionTab($request->tab);

        YearRecord::create([
            'year' => $request->year,
            'title' => $request->title,
            'status' => 0,
        ]);
    }

    private function isYearAlreadyActive($selectedYearId)
    {
        $activeYear = YearRecord::where('status', 1)->first();

        return $activeYear && $activeYear->id == $selectedYearId;
    }

    private function activateSelectedYear($selectedYearId)
    {
        $this->setSessionTab(request()->tab);

        YearRecord::where('id', $selectedYearId)->update(['status' => 1]);
        YearRecord::where('id', '!=', $selectedYearId)->update(['status' => 0]);
    }

    private function setSessionTab($tab)
    {
        session(['tab' => $tab, 'expires_at' => time() + 1]);
    }

    private function redirectWithNotification($message, $title = null, $detail = null)
    {
        $notification = ['message' => $message];

        if ($title && $detail) {
            $notification['yearMessageTitle'] = $title;
            $notification['yearMessage'] = $detail;
        }

        return redirect()->route('manage.year')->with($notification);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $displayByEvent = $request->has('display_by_event');

        // Update the config file
        $this->updateConfig(['display_donations_by_event' => $displayByEvent]);

        // Clear the config cache
        \Artisan::call('config:cache');

        // return redirect()->back()->with('success', 'Setting updated successfully!');

        $notification = array(
            'message' => 'Setting updated successfully!',
        );
\Log::info(session()->all());
        return redirect()->back()->with($notification);
    }

    protected function updateConfig($data = [])
    {
        $configPath = config_path('displayDonation.php');

        if (File::exists($configPath)) {
            $config = include($configPath);
            $config = array_merge($config, $data);
            
            $content = "<?php\n\nreturn " . var_export($config, true) . ";\n";
            File::put($configPath, $content);

            return true;
        }

        return false;
    }
}

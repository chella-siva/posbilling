namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class ArtisanController extends Controller
{
    // Clear application cache
    public function clearCache()
    {
        Artisan::call('cache:clear');
        return response()->json(['message' => 'Application cache cleared successfully!']);
    }

    // Clear configuration cache
    public function clearConfig()
    {
        Artisan::call('config:clear');
        return response()->json(['message' => 'Configuration cache cleared successfully!']);
    }

    // Clear session data
    public function clearSession()
    {
        Artisan::call('session:clear');
        return response()->json(['message' => 'Session data cleared successfully!']);
    }

    // Clear compiled views
    public function clearViews()
    {
        Artisan::call('view:clear');
        return response()->json(['message' => 'Compiled views cleared successfully!']);
    }
}

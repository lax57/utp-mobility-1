<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;
use App\Application;
use Illuminate\Support\Collection;


class NotificationController extends Controller
{
    public function showAllUserNotifications(){
        //TODO: get only notifications of the user logged in 
        if(Auth::User()->isSolicitante()){
            $applications = Application::with('notifications')->where('cedula', '20-57-4151')->get();
            
            $notifications = new Collection;

            foreach ($applications as $application) {
                $notifications = $notifications->merge($application->notifications, $notifications);
            }
            $notifications = $notifications->sortByDesc('date_of_update');
            return view('notifications', ['notifications'=>$notifications]);
        } else 
            abort(404);
    }
    
    public function markAsRead(Request $request){
        $not = Notification::find($request['notification_id']);
        $not->seen = 1; 
        $not->save();
    }
    
    public function getLastNotifications(Request $request){
        $applications = Application::with('notifications')->where('cedula', '20-57-4151')->get();

        $notifications = new Collection;

        foreach ($applications as $application) {
            $notifications = $notifications->merge($application->notifications, $notifications);
        }
        $notifications->splice(3);
        return response()->json($notifications);
    }
    
}
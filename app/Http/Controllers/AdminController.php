<?php
namespace App\Http\Controllers;
use App\Role;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function showRegisterAccountForm()
    {
        $roles = Role::all();
        $units = Unit::all();
        return view('admin.register_account',['roles'=>$roles, 'units'=>$units]);
    }
    
    public function showDashboard()
    {
        return view('admin.dashboard');
    }
    
    public function showAccounts()
    {
        $accounts = User::all();
        return view('admin.accounts', ['accounts'=>$accounts]);
    }
    
    public function deleteAccount($account_id)
    {
        $account = User::where('id', $account_id)->first();
        $account->delete();
        return redirect()->back();
    }
    
    public function registerAccount(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email|max:50|min:2|unique:users',
            'password'=>'max:255|min:2',
            'password_confirmation'=>'required|same:password',
            'name'=>'min:2|max:50|required',
            'last_name'=>'min:2|max:50|required',
        ]);
        
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->last_name = $request['last_name'];
        $user->creation_date = date("Y-m-d");
        
        $unit = Unit::where('name', $request["unit"])->firstOrFail();
        $user->unit()->associate($unit);
        
        DB::beginTransaction();
        $user->save();
        
        foreach($request["user_roles"] as $role){
            $type = Role::where('name', $role)->firstOrFail();
            $user->roles()->attach($type);
        }
        DB::commit();
        
        return redirect()->route('show_accounts');
    }
}
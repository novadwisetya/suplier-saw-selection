<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;

use App\User;
use App\Models\Employee;
use App\Role;
use Mail;
use Log;

class EmployeesController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'mobile', 'address', 'email'];
	
	public function __construct() {
		
	}
	
	/**
	 * Display a listing of the Employees.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Employees');

		return View('la.employees.index', [
			'show_actions' => $this->show_action,
			'listing_cols' => $this->listing_cols,
			'module' => $module
		]);
	}

	/**
	 * Show the form for creating a new employee.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created employee in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		
			$rules = Module::validateRules("Employees", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			// generate password

			$password = $request->password;
			
			// Create Employee
			$employee_id = Module::insert("Employees", $request);
			// Create User
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => bcrypt($password),
				'context_id' => $employee_id,
				'type' => "Employee",
				'role' => $request->bagian,
				'gender' => $request->gender
			]);
	
			// update user role
			$user->detachRoles();
			$role = Role::find($request->role);
			$user->attachRole($role);
			
			if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
				// Send mail to User his Password
				Mail::send('emails.send_login_cred', ['user' => $user, 'password' => $password], function ($m) use ($user) {
					$m->from('hello@laraadmin.com', 'LaraAdmin');
					$m->to($user->email, $user->name)->subject('LaraAdmin - Your Login Credentials');
				});
			} else {
				Log::info("User created: username: ".$user->email." Password: ".$password);
			}
			
			return redirect()->route(config('laraadmin.adminRoute') . '.employees.index');
	}

	/**
	 * Display the specified employee.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
			
			$employee = Employee::find($id);
			if(isset($employee->id)) {
				$module = Module::get('Employees');
				$module->row = $employee;
				
				// Get User Table Information
				$user = User::where('context_id', '=', $id)->firstOrFail();
				
				return view('la.employees.show', [
					'user' => $user,
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('employee', $employee);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("employee"),
				]);
			}
	}

	/**
	 * Show the form for editing the specified employee.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
			$employee = Employee::find($id);
			if(isset($employee->id)) {
				$module = Module::get('Employees');
				
				$module->row = $employee;
				
				// Get User Table Information
				$user = User::where('context_id', '=', $id)->firstOrFail();
				
				return view('la.employees.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
					'user' => $user,
				])->with('employee', $employee);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("employee"),
				]);
			}
	}

	/**
	 * Update the specified employee in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
			
			$rules = Module::validateRules("Employees", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$employee_id = Module::updateRow("Employees", $request, $id);
        	
			// Update User
			$user = User::where('context_id', $employee_id)->first();
			$user->name = $request->name;
			$user->save();
			
			// update user role
			$user->detachRoles();
			$role = Role::find($request->role);
			$user->attachRole($role);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.employees.index');
	}

	/**
	 * Remove the specified employee from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
			Employee::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.employees.index');
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('employees')->select(['id', 'name', 'address', 'email'])->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Employees');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="#">'.$data->data[$i][$j].'</a>';
				}
			}
			
			if($this->show_action) {
				$output = '';
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/employees/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
					
					if($data->data[$i][3] != Auth::user()->email){
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.employees.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i></button>';
					}
					$output .= Form::close();
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
	
	/**
     * Change Employee Password
     *
     * @return
     */
	public function change_password($id, Request $request) {
		
		$validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
			'password_confirmation' => 'required|min:6|same:password'
        ]);
		
		if ($validator->fails()) {
			return \Redirect::to(config('laraadmin.adminRoute') . '/employees/'.$id)->withErrors($validator);
		}
		
		$employee = Employee::find($id);
		$user = User::where("context_id", $employee->id)->where('type', 'Employee')->first();
		$user->password = bcrypt($request->password);
		$user->save();
		
		\Session::flash('success_message', 'Password is successfully changed');
		
		// Send mail to User his new Password
		if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
			// Send mail to User his new Password
			Mail::send('emails.send_login_cred_change', ['user' => $user, 'password' => $request->password], function ($m) use ($user) {
				$m->from(LAConfigs::getByKey('default_email'), LAConfigs::getByKey('sitename'));
				$m->to($user->email, $user->name)->subject('LaraAdmin - Login Credentials chnaged');
			});
		} else {
			Log::info("User change_password: username: ".$user->email." Password: ".$request->password);
		}
		
		return redirect(config('laraadmin.adminRoute') . '/employees/'.$id.'#tab-account-settings');
	}
}

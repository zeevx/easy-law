<?php

namespace Modules\RolePermission\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Http\Requests\RoleFormRequest;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->middleware(['auth']);
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {

        try{
            $data['RoleList'] = $this->roleRepository->all();
            return view('rolepermission::role', $data);

        }catch (\Exception $e) {

            Toastr::error(__("common.Something Went Wrong"));
            return back();
        }


    }

    public function create()
    {
        return view('rolepermission::create');
    }

    public function store(RoleFormRequest $request)
    {
        try {
            $delete = $this->roleRepository->create($request->except("_token"));
            Toastr::success(__('common.Role Create Successful'), __('common.Success'));
            return redirect()->route('permission.roles.index');
        } catch (\Exception $e) {

            return back();
        }
    }

    public function show($id)
    {
        return view('rolepermission::show');
    }

    public function edit(Role $role)
    {
        try {
            $RoleList = $this->roleRepository->all();
            return view('rolepermission::role', compact('RoleList', 'role'));
        } catch (\Exception $e) {
            Toastr::error(__("common.Something Went Wrong"), __('common.Failed'));
            return redirect()->back();
        }
    }

    public function update(RoleFormRequest $request, $id)
    {
        try {
            $role = $this->roleRepository->update($request->except("_token"), $id);
            Toastr::success(__('common.Role Update Successful'), __('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->route('permission.roles.index');
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->roleRepository->delete($id);

            if ($delete){
                Toastr::success(__('common.Role Delete Successful'), __('common.Success'));
            } else{
                Toastr::error(__('common.Role is assign to staffs.'));
            }
            return redirect()->back();
        } catch (\Exception $e) {

            return redirect()->back();
        }
    }

    public function roleUsers(Request $request)
    {
        $repo = new UserRepository();
        $users = $repo->staffs($request->role_id);

        if (count($users) > 0)
        {
            $output ='<option value="">'.trans('common.Select One').'</option>';
            foreach ($users as $user)
            {
                $output .= '<option value="'.$user->id.'">'.$user->name.'</option>';
            }
        }
        else
            $output = '<option>'.trans('common.No data Found').'</option>';

        return $output;
    }

}

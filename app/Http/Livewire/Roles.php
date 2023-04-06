<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Validation\Rule;
  
class Roles extends Component
{
    public $roles, $role_id, $name;
    public $role, $rolePermissions, $permissions, $asignedPermissions;
    public $isOpenUpdate = 0, $isOpenShow = 0, $isOpenList = 1;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->roles = Role::all();
        return view('livewire.roles.index');
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->handleTabs('isOpenUpdate','isOpenList');
        // $this->openUpdate();
    }

    public function show($id)
    {
        // $role = $role;
        $role = Role::findOrFail($id);
        $this->role = Role::find($id);
        $this->rolePermissions = $role->permissions;

        $this->role_id = $id;
        $this->name = $role->name;
  
        $this->handleTabs('isOpenShow','isOpenList');
    
        // return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function handleTabs($toOpen, $toClose, $method = null){
      if($method!=null){
        if($this->$method()){
          $this->$toOpen = true;
          $this->$toClose = false;
          return;
        };
      }

      $this->$toOpen = true;
      $this->$toClose = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->role_id = '';
        $this->name = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'name' => ['required', Rule::unique('roles')->ignore($this->role_id)],
            // 'name' => 'required|unique:roles,name,'.$this->role_id,
        ]);

        $role = Role::updateOrCreate(['id' => $this->role_id], [
            'name' => $this->name,
        ]);


        // $role->update($request->only('name'));
    
        $role->syncPermissions($this->rolePermissions);
  
        session()->flash('message', 
            $this->role_id ? 'Role Updated Successfully.' : 'Role Created Successfully.');
  
        $this->handleTabs('isOpenList', 'isOpenUpdate');
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $role->name;

        $this->role = Role::find($id);
        $this->permissions = Permission::get();
        $this->rolePermissions = $role->permissions->pluck('name')->toArray();
  
        $this->handleTabs('isOpenUpdate','isOpenList');
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'Role Deleted Successfully.');
    }
}
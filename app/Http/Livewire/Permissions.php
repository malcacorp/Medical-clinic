<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use Spatie\Permission\Models\Permission;

use Illuminate\Validation\Rule;
  
class Permissions extends Component
{
    public $permissions, $permission_id, $name;
    public $permission;
    public $isOpenUpdate = 0, $isOpenList = 1;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->permissions = Permission::all();
        return view('livewire.permissions.index');
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
        $this->permission_id = '';
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
            'name' => ['required', Rule::unique('permissions')->ignore($this->permission_id)],
            // 'name' => 'required|unique:permissions,name,'.$this->permission_id,
        ]);

        Permission::updateOrCreate(['id' => $this->permission_id], [
            'name' => $this->name,
        ]);
  
        session()->flash('message', 
            $this->permission_id ? 'Permission Updated Successfully.' : 'Permission Created Successfully.');
  
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
        $permission = Permission::findOrFail($id);
        $this->permission_id = $id;
        $this->name = $permission->name;

        $this->permission = Permission::find($id);

  
        $this->handleTabs('isOpenUpdate','isOpenList');
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('message', 'Permission Deleted Successfully.');
    }
}
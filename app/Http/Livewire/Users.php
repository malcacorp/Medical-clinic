<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Validation\Rule;
  
class Users extends Component
{
    public $users, $user_id, $name;
    public $user, $userRoles, $roles, $asignedRoles;
    public $isOpenUpdate = 0, $isOpenShow = 0, $isOpenList = 1;
    public $search = '';
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        if ($this->search != '') {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->users = User::all();
        }

        return view('livewire.users.index');
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
        // $user = $user;
        $user = User::findOrFail($id);
        $this->user = User::find($id);
        $this->userRoles = $user->roles;

        $this->user_id = $id;
        $this->name = $user->name;
  
        $this->handleTabs('isOpenShow','isOpenList');
    
        // return view('users.show', compact('user', 'userRoles'));
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
        $this->user_id = '';
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
            'name' => ['required', Rule::unique('users')->ignore($this->user_id)],
            // 'name' => 'required|unique:users,name,'.$this->user_id,
        ]);

        $user = User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
        ]);


        // $user->update($request->only('name'));
    
        $user->syncRoles($this->userRoles);
  
        session()->flash('message', 
            $this->user_id ? 'User Updated Successfully.' : 'User Created Successfully.');
  
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
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;

        $this->user = User::find($id);
        $this->roles = Role::get();
        $this->userRoles = $user->roles->pluck('name')->toArray();
  
        $this->handleTabs('isOpenUpdate','isOpenList');
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
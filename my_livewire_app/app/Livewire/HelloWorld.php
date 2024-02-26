<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CsvExport;

class HelloWorld extends Component
{
    use WithPagination;

    public $search='';
    public $name;
    public $email;
    public $password;

    // public function updatedSearch(){
    //     $this->resetPage();
    // }

    public function addNewUser()
    {
        $this->validate(
            [
                "name"=> [
                    "required",
                    "string",
                    "unique:users"
                ],
                "email"=> [
                    "required",
                    "string",
                    "unique:users"
                ],
                "password"=> [
                    "required",
                ]
            ]
        );

        User::create([
            "name"     => $this->name,
            "email"    => $this->email,
            "password" => $this->password
        ]);

        $this->reset(
            [
                "name",
                "email",
                "password"
            ]
        );

        request()->session()->flash("success_create","User created successfully");
    }

    // public function editUser(int $id)
    // {
    //     $user = User::find($id);
    //     return view('', compact('user'));
    // }

    // public function showUser(int $id)
    // {
    //     $user = User::find($id);
    //     return view('', compact('user'));
    // }

    // public function updateUser(User $user)
    // {
    //     $user->name = ''. $user->name;
    //     $user->email = ''. $user->email;
    //     $user->password = ''. $user->password;
    //     $user->save();
    // }

    public function deleteUser(int $id)
    {
        if ($id != auth()->user()->id) {
            User::find($id)->delete();
            request()->session()->flash("success_delete","User deleted successfully");

        } else {
            request()->session()->flash("failed_delete","Failed to delete Current User");
        }
    }

    // Excel data exports
    public function excelExport()
    {
        return Excel::download(new ExcelExport(User::all()), 'my_users_'. time(). '.xlsx');
    }

    // CSV Data export
    public function csvExport()
    {
        return Excel::download(new CsvExport(User::all()), 'my_users_'. time(). '.csv');
    }

    public function render()
    {
        $all_users = User::all();
        $users = User::query()
        ->when($this->search, function($q){
            $q->where('name','like','%'. $this->search .'%')
            ->orWhere('email','like','%'. $this->search .'%');
        })->paginate(5);

        return view('livewire.hello-world', compact('users', 'all_users'));
    }
}

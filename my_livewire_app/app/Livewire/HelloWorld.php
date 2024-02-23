<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class HelloWorld extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;

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
            request()->session()->flash("failed_delete","Failed to delete User");
        }
    }

    public function excelExport()
    {
        $model = User::all();

        return Excel::download(new ExcelExport($model), 'my_users.xlsx');
    }

    // TODO
    public function csvExport()
    {
        $model = User::all();
        // 
    }

    public function render()
    {
        $all_users = User::all();
        $users = User::paginate(5);

        return view('livewire.hello-world', compact('users', 'all_users'));
    }
}

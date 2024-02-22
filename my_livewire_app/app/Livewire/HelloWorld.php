<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class HelloWorld extends Component
{
    public $name;
    public $email;
    public $password;

    public function addNewUser()
    {
        User::create([
            "name"     => $this->name,
            "email"    => $this->email,
            "password" => $this->password
            // "email_verified_at" => null,
            // "remember_token"    => null
        ]);

        // dd("IT WORKS");
        // try {
        //     User::create([
        //         "name"              => "User ". $this->increment,
        //         "email"             => "san.manyike". $this->increment. "@gmail.com",
        //         "password"          => "$2a$12\$GBHonbJ5oOCBP44XYyXcwu2sRf3ZdPm7oy98iNwpLO1cERqLjBCBW",
        //         "email_verified_at" => null,
        //         "remember_token"    => null
        //     ]);
                
        //     return redirect()->route('dashboard')->with('success', 'User created');
        // } catch (\Exception $e) {
        //     // Handle the exception
        //     return redirect()->back()->with('error', 'Failed to create user');
        // }
    }

    // public function editUser(int $id)
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
        } else {
            dd("You can't delete yyour user");
        }
    }

    public function render()
    {
        $test_data = [
            'name' => 'Test Name',
            'age' => 20
        ];

        $users = User::all();

        return view('livewire.hello-world', compact('test_data', 'users'));
    }
}

<div class="container text-center" style="background-color: black; opacity: 0.7; border-radius: 8px;">
    <div class="text-center">
        <div class="mb-4"></div>
        <hr>
        <div class="display-3 text-white">
            <span>
                You have {{ count($all_users) }} users
            </span>
        </div>
        <hr style="border-color: white;">
        <div class="text-center">
            <div class="accordion" id="accordionExample" style="padding: 0 10%;">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Click To Add New User
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if(session('success_create'))
                                <div class="w-100 p-2 mb-2 text-success" style="border: 2px solid green; border-radius: 8px; position: relative;">
                                    <div style="position: absolute; right: 0; top: 0; width: 15%; height: 100%; background-color: green;"></div>
                                    {{ session('success_create') }}
                                </div>
                            @endif
                            @if(session('failed_create'))
                                <div class="w-100 p-2 mb-2 text-danger" style="border: 2px solid red; border-radius: 8px; position: relative;">
                                    <div style="position: absolute; right: 0; top: 0; width: 15%; height: 100%; background-color: red;"></div>
                                    {{ session('failed_delete') }}
                                </div>
                            @endif
                            @if(session('success_delete'))
                                <div class="w-100 p-2 mb-2 text-success" style="border: 2px solid green; border-radius: 8px; position: relative;">
                                    <div style="position: absolute; right: 0; top: 0; width: 15%; height: 100%; background-color: green;"></div>
                                    {{ session('success_delete') }}
                                </div>
                            @endif
                            @if(session('failed_delete'))
                                <div class="w-100 p-2 mb-2 text-danger" style="border: 2px solid red; border-radius: 8px; position: relative;">
                                    <div style="position: absolute; right: 0; top: 0; width: 15%; height: 100%; background-color: red;"></div>
                                    {{ session('failed_delete') }}
                                </div>
                            @endif
                            <form wire:submit="addNewUser" action="">
                                <div class="form-control">
                                    @error('name')
                                        <div class="text-start text-danger">
                                            <span> {{ $message }} </span>                                            
                                        </div>
                                    @enderror
                                    <input type="text" wire:model="name" placeholder="Name" class="w-100 mb-2">
                                    @error('email')
                                        <div class="text-start text-danger">
                                            <span> {{ $message }} </span>                                            
                                        </div>
                                    @enderror
                                    <input type="email" wire:model="email" placeholder="Email" class="w-100 mb-2">
                                    @error('password')
                                        <div class="text-start text-danger">
                                            <span> {{ $message }} </span>                                            
                                        </div>
                                    @enderror    
                                    <input type="password" wire:model="password" placeholder="Passsword" class="w-100 mb-2">
                                </div>
                                <button type="button" class="btn btn-success mt-2 w-100" wire:click.prevent="addNewUser()">Create User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-4"></div>
        <div class="pb-2" style="border-radius: 8px; padding: 0 10%;">
            <input type="text" class="form-control" wire:model.live="search"/>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">
                            <span>Exports</span>&nbsp;
                            <img width="40" height="40" src="https://img.icons8.com/fluency/48/microsoft-excel-2019.png" alt="microsoft-excel-2019" wire:click="excelExport" style="cursor:pointer;"/>
                            <img width="40" height="40" src="https://img.icons8.com/papercut/60/csv.png" alt="csv" wire:click="csvExport" style="cursor:pointer;"/>
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name ?? 'To be added' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span>
                                    <button type="button" class="btn btn-danger" wire:click="deleteUser({{ $user->id }})">Delete</button>
                                </span>
                                <span>
                                    <button type="button" class="btn btn-primary" wire:click="editUser({{ $user->id }})">Edit</button>
                                </span>
                                <span>
                                    <button type="button" class="btn btn-success" wire:click="showUser({{ $user->id }})">Show</button>
                                </span>            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-4 text-end">
                <div class="d-inline-block">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


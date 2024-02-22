<div class="container text-center" style="background-color: black; opacity: 0.7; border-radius: 20px;">
    <div class="text-center">
        <div class="mb-4"></div>
        <hr>
        <div class="display-3 text-white">
            <span>
                You have {{ count($users) }} users
            </span>
        </div>
        <hr style="border-color: white;">
        <div class="text-center">
            <div class="accordion" id="accordionExample" style="padding: 0 20%;">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Click To Add New User
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form wire:submit="addNewUser" action="">
                                <div class="form-control">
                                    <input type="text" wire:model="name" placeholder="Name" class="w-100 mb-2">
                                    <input type="email" wire:model="email" placeholder="Email" class="w-100 mb-2">
                                    <input type="password" wire:model="password" placeholder="Passsword" class="w-100 mb-2">
                                </div>
                                <button type="button" class="btn btn-success mt-4" wire:click.prevent="addNewUser">Create User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="border-color: white;">
        @foreach($users as $user)
            <div class="text-center text-white">
                <span>
                    Name : {{ $user->name }}
                </span>&nbsp;
                <span>
                    Email : {{ $user->email }}
                </span>&nbsp;
                <span>
                    <button type="button" class="btn btn-danger"  wire:click="deleteUser({{ $user->id }})">Delete {{ $user->name }}</button>
                </span>
                <span>
                    <button type="button" class="btn btn-primary"  wire:click="editUser">Edit {{ $user->name }}</button>
                </span>
                <hr style="border-color: white;">
            </div>
        @endforeach
    </div>
</div>


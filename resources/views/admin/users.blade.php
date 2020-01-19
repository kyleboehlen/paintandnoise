@extends('layouts.admin')

@section('body')
    <div class="users-card">
        <br/><br/>
        <div class="card-header">Users</div><br/><br/>

        <div class="card-body">
            @if($user->checkPermissions(\App\Http\Permissions\Admin::VIEW_ADMINS))
                <form action="{{ route('admin.users.redirect') }}" method="POST">
                    <select name="user-id">
                        @foreach(\App\Models\Admin\AdminUsers::all() as $admin_user)
                            <option value="{{ $admin_user->id }}">
                                {{ $admin_user->name }}
                            </option>
                        @endforeach
                    </select><br/><br/>

                    <input type="submit" value="Select" />
                </form>
            @endif

            @if($user->checkPermissions(\App\Http\Permissions\Admin::CREATE_ADMINS))
                <p> -- or -- </p>
                <form action="{{ route('admin.users.create') }}" method="POST">
                    @csrf
                    
                    <label for="name">Name</label><br/>
                    <input id="name" type="text" name="name" required/><br/>

                    <label for="email">Email</label><br/>
                    <input id="email" type="email" name="email" required/><br/><br/>

                    <input type="submit" value="Add" /><br/><br/>
                </form>
            @endif
        </div>
    </div>
@endsection

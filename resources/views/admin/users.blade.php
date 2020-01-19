@extends('layouts.admin')

@section('body')
    <div class="users-card">
        <br/><br/>
        <div class="card-header">Users</div><br/><br/>

        <div class="card-body">
            @if($admin->checkPermissions(\App\Http\Permissions\Admin::VIEW_ADMINS))
                <form action="{{ route('admin.users.redirect') }}" method="POST">
                    @csrf

                    <select name="user-id" class="@if($errors->has('user-id')) is-invalid @endif">
                        @foreach(\App\Models\Admin\AdminUsers::all()->sortBy('name') as $admin_user)
                            @if($admin_user->id != 1) {{-- Don't display super admin --}}
                                <option value="{{ $admin_user->id }}">
                                    {{ $admin_user->name }}
                                </option>
                            @endif
                        @endforeach
                    </select><br/><br/>

                    @if($errors->has('user-id'))
                        <span class="invalid-feedback" role="alert">
                            @if(is_array($errors->get('user-id')))
                                @foreach($errors->get('user-id') as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            @else
                                <strong>{{ $errors->get('user-id') }}</strong>
                            @endif
                        </span>
                        <br/><br/>
                    @endif

                    <input type="submit" value="Select" />
                </form>
            @endif

            @if($admin->checkPermissions(\App\Http\Permissions\Admin::CREATE_ADMINS))
                <p> -- or -- </p>
                <form action="{{ route('admin.users.create') }}" method="POST">
                    @csrf

                    <label for="name">Name</label><br/>
                    <input id="name" type="text" name="name" class="@if($errors->has('name')) is-invalid @endif" required/><br/>

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            @if(is_array($errors->get('name')))
                                @foreach($errors->get('name') as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            @else
                                <strong>{{ $errors->get('name') }}</strong>
                            @endif
                        </span>
                        <br/><br/>
                    @endif

                    <label for="email">Email</label><br/>
                    <input id="email" type="email" name="email" class="@if($errors->has('email')) is-invalid @endif" required/><br/><br/>

                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            @if(is_array($errors->get('email')))
                                @foreach($errors->get('email') as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            @else
                                <strong>{{ $errors->get('email') }}</strong>
                            @endif
                        </span>
                        <br/><br/>
                    @endif

                    <input type="submit" value="Add" /><br/><br/>
                </form>
            @endif
        </div>
    </div>
@endsection

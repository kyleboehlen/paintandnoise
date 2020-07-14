@extends('layouts.admin')

@section('body')
    <div class="users-card">
        <br/><br/>
        <div class="card-header">
            @isset($user) {{ $user->name }} @endisset
            @empty($user) Users @endempty
        </div><br/><br/>

        <div class="card-body">
            @if($show == 'index')
                @if($admin->checkPermissions($permissions::VIEW_ADMIN))
                    <form action="{{ route('admin.users.redirect') }}" method="POST">
                        @csrf

                        <select name="user-id" class="@if($errors->has('user-id')) is-invalid @endif">
                            @foreach($admin_users::all()->sortBy('name') as $admin_user)
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

                @if($admin->checkPermissions($permissions::CREATE_ADMIN))
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
            @elseif($show == 'view')
                @if($admin->checkPermissions($permissions::DELETE_ADMIN))
                    <form id="delete-form" action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                        @csrf
                    </form>

                    @if(session('failed-deletion'))
                        <div class="invalid-feedback" role="alert">
                            <p>Failed to delete user.</p>
                        </div>
                    @endif

                    <a class="delete-link" href="{{ route('admin.users.delete', $user->id) }}" 
                        onclick="event.preventDefault();
                            document.getElementById('delete-form').submit();">
                        Delete
                    </a><br/><br/>
                @endif

                @if($admin->checkPermissions($permissions::RESET_ADMIN_PASSWORD))
                    <form id="reset-password-form" action="{{ route('admin.users.password', $user->id) }}" method="POST">
                        @csrf
                    </form>

                    @if(session('sent'))
                        <div class="alert-success" role="alert">
                            <p>A password reset link has been sent!</p>
                        </div>
                    @endif

                    <a class="reset-password-link" href="{{ route('admin.users.password', $user->id) }}" 
                        onclick="event.preventDefault();
                            document.getElementById('reset-password-form').submit();">
                        Send Reset Password To:<br/>{{ $user->email }}
                    </a><br/><br/>
                @endif

                <form id="permissions-form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    
                    <p class="permissions-label">Permissions</p>

                    <div class="permissions-container">
                        @foreach($admin_permissions::all() as $permission)
                            <span class="permissions-item" title="{{ $permission->description }}">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    @if($user->checkPermissions($permission->id))
                                        checked
                                    @endif

                                    @if(!$admin->checkPermissions($permissions::GRANT_ADMIN_PERMISSIONS))
                                        disabled
                                    @endif
                                >&nbsp;&nbsp;{{ $permission->name }}
                            </span>
                        @endforeach
                    </div>

                    @if($admin->checkPermissions($permissions::GRANT_ADMIN_PERMISSIONS))
                        <input type="submit" value="Update" /><br/><br/>
                    @endif
                </form><br/>
            @endif
        </div>
    </div>
@endsection

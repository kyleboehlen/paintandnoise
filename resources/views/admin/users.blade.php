@extends('layouts.admin')

@section('body')
    <div class="users-card">
        <br/><br/>
        <div class="card-header">
            @isset($card_header) {{ $card_header }} @endisset
            @empty($card_header) Users @endempty
        </div><br/><br/>

        <div class="card-body">
            @if($show == 'index')
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
            @elseif($show == 'view')
                @if($admin->checkPermissions(\App\Http\Permissions\Admin::DELETE_ADMINS))
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

                @if($admin->checkPermissions(\App\Http\Permissions\Admin::RESET_ADMIN_PASSWORDS))
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
                        Send Reset Password To: {{ $user->email }}
                    </a><br/><br/>
                @endif

                <form id="permissions-form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    
                    <p class="permissions-label">Permissions</p>

                    <div class="permissions-container">
                        @foreach(\App\Models\Admin\AdminPermissions::all() as $permission)
                            <span class="permissions-item" title="{{ $permission->description }}">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    @if($user->checkPermissions($permission->id))
                                        checked
                                    @endif

                                    @if(!$admin->checkPermissions(\App\Http\Permissions\Admin::GRANT_ADMIN_PERMISSIONS))
                                        disabled
                                    @endif
                                >&nbsp;&nbsp;{{ $permission->name }}
                            </span>
                        @endforeach
                    </div>

                    @if($admin->checkPermissions(\App\Http\Permissions\Admin::GRANT_ADMIN_PERMISSIONS))
                        <input type="submit" value="Update" /><br/><br/>
                    @endif
                </form><br/>
            @endif
        </div>
    </div>
@endsection

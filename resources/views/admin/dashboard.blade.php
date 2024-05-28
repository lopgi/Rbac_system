@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-body">
            @if(Session::has('success'))
                      <div class="alert alert-success">
                          {{Session::get('success')}}
                      </div>
                      @endif
                      @if(Session::has('error'))
                                  <div class="alert alert-success">
                                      {{Session::get('error')}}
                                  </div>
                      @endif
                      @if(Session::has('fail'))
                          <div class="alert alert-danger">
                          {{Session::get('fail')}}
                          </div>
                      @endif
                <!-- Button to trigger Add User modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
                    Add User
                </button>
                <br>

                <h3 class="card-title">Users</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user_details as $value)
                        <tr>
                            <th>{{$value->id}}</th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->role_name}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Add User Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('add_user')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group">
                                        <label for="permission" class="form-label">Role</label>
                                        <select class="form-control" id="role" name="role">
                                            <option selected>Select role</option>
                                            @foreach($editor_details as $value)
                                           <option value="{{$value->id}}">{{$value->role_name}}</option>

                                           @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>

                <br>

                <!-- Button to trigger Add Role modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addRoleModal">
                    Add Role
                </button>
                <br>

                <h2>Roles</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Permission</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($editor_details as $value)
                        <tr>
                            <th>{{$value->id}}</th>
                            <td>{{$value->role_name}}</td>
                            <td><?php $permissions = json_decode($value->permission_name); ?>
                            @foreach($permissions as $permission)
                                <span class="badge badge-primary">{{$permission}}</span>
                            @endforeach
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRoleLabel">Add Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('editors') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="roleName">Role Name:</label>
                                        <input type="text" class="form-control" id="roleName" name="roleName">
                                    </div>
                                    <div class="form-group">
                                        <label for="permission" class="form-label">Choose an option</label>
                                        <select class="form-control" id="permission" name="permission[]" multiple>
                                            <option selected>Choose permission</option>
                                            <option value='create-post'>create-post</option>
                                            <option value='edit-post'>edit-post</option>
                                            <option value='publish-post'>publish-post</option>
                                            <option value='delete-post'>delete-post</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

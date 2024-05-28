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
                
                <br>

                <h3 class="card-title">posts</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($posts_details as $posts)
                    <tr>
                        <td>{{$posts->id}}</td>
                        <td>{{$posts->post_name}}</td>
                        <td>@if($posts->status == 0)
                            created
                            @endif
                        </td>
                        <td>
                        @foreach($getpermission as $permission)
    @php
        $permissions = json_decode($permission->permission_name);
    @endphp

    @foreach($permissions as $singlePermission)
        <button class="btn btn-primary">{{ $singlePermission }}</button>
    @endforeach
@endforeach
                        </td>


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
                              <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Post Name:</label>
                                    <input type="text" class="form-control" name="name">
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

              
            </div>
        </div>
    </section>
</div>
@endsection

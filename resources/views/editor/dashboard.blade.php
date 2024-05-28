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
                @if(Auth::user()->role_id== 1)
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">Add post</button>
                @endif

               <table class="table table-bordered"> </br>
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
                            @elseif($posts->status == 1)
                            published
                            @endif
                        </td>
                        <td>
    @foreach($getpermission as $permission)
        @php
            $permissions = json_decode($permission->permission_name);
        @endphp

        @foreach($permissions as $singlePermission)
            @php
                $actions = explode(',', $singlePermission);
            @endphp

            @foreach($actions as $action)
                @if($action == 'publish-post')
                    <form action="{{route('publish_post',['id' => $posts->id])}}" method="POST" style="display: inline;">
                        @csrf
                        @if($posts->id && $posts->status == 0)
                        <button type="submit" class="btn btn-success">Publish</button>

                            @else($posts->id && $posts->status == 1)
                           
                        <button type="submit" class="btn btn-warning">UnPublish</button>
                       @endif
                    </form>
                @elseif($action == 'edit-post')
                    <form action="" method="GET" style="display: inline;">
                        <button type="submit" class="btn btn-secondary">Edit</button>
                    </form>
                @elseif($action == 'delete-post')
                    <form action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            @endforeach
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
                                <h5 class="modal-title" id="addUserLabel">Add post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('addposts')}}" method="post">
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

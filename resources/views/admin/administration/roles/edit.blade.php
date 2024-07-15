@extends('admin.layout.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Administrator /</span> Roles / Edit</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Role Information</h5>
                    <form method="POST" action="{{route('roles.update', $role->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                              <div>
                                  <label for="name">Name</label>
                                  <input
                                  type="text"
                                  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                  id="name"
                                  name="name"
                                  value="{{$role->name}}"
                                  placeholder="Role Name" />
                                  @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div>
                                  <label for="display_name" class="form-label">Display Name</label>
                                  <input
                                  type="text"
                                  class="form-control"
                                  id="display_name"
                                  name="display_name"
                                  value="{{$role->display_name}}"
                                  placeholder="Display Name" />
                                  <!-- <span> We'll never share your details with anyone else.</span> -->
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div>
                                  <label for="description" class="form-label">Description</label>
                                  <textarea name="description"  class="form-control" id="description" placeholder="Description">{{$role->description}}</textarea>

                                  <!-- <span>  We'll never share your details with anyone else.</span> -->
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer text-muted">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-check" style="float: right;">
                            <a href="{{route('roles.index')}}" class="btn btn-primary">Back</a>
                            <input type="hidden" name="type" value="role">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <h5 class="card-header">Permissions</h5>
                    <form method="POST" action="{{route('roles.update', $role->id)}}">
                      @csrf
                      @method('PUT')
                      <div class="card-body">
                        <div class="row gy-3">
                        <div class="col-md-12">
                            <!-- <div class="col-md">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Users </label>
                              </div>
                            </div> -->

                              <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                  <div class="form-check mt-3">
                                      <input
                                          class="form-check-input"
                                          type="checkbox"
                                          name="permissions[]"
                                          value="{{ $permission->id }}"
                                          id="permission_{{ $permission->id }}"
                                          @checked($role->hasPermission($permission->name))
                                      />
                                      <label class="form-check-label" for="permission_{{ $permission->id }}">
                                          {{ $permission->display_name }}
                                      </label>
                                  </div>
                              </div>
                                @endforeach
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer text-muted">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-check" style="float: right;">
                            <a href="{{route('roles.index')}}" class="btn btn-primary">Back</a>
                            <input type="hidden" name="type" value="permissions">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


@endsection

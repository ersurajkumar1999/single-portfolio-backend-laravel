@extends('admin.layout.main')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Administrator /</span> Permissions</h4>
              <div class="card">
                <h5 class="card-header"> Permissions List</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Display Name</th>
                      <th>Description</th>
                      <th>Actions</th>
                  </tr>
                    </thead>
                    <tbody>
                      @foreach ($permissions as $permission)
                        <tr>
                          <td>{{ $permission->name }}</td>
                          <td>{{ $permission->display_name }}</td>
                          <td>{{ $permission->description }}</td>
                            <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('permissions.show', $permission->id)}}">
                                  <i class="bx bx-show-alt me-1"></i> Show</a>
                                <a class="dropdown-item" href="{{route('permissions.edit', $permission->id)}}">
                                  <i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);" >
                                  <i class="bx bx-trash me-1"></i> Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <!-- <tfoot class="table-border-bottom-0">
                    <tr>
                      <th>Name</th>
                      <th>Display Name</th>
                      <th>Description</th>
                      <th>Actions</th>
                  </tr>
                    </tfoot> -->
                  </table>
                </div>
              </div>
            </div>
@endsection

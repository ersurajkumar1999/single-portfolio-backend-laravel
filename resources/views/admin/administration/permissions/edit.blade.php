@extends('admin.layout.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Role Information</h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div>
                                
                                <label for="name">Name</label>
                                <input
                                type="text"
                                class="form-control"
                                id="name"
                                value="{{$role->name}}"
                                placeholder="Role Name" />
                                <!-- <span class="">  We'll never share your details with anyone else.</span> -->
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="display_name" class="form-label">Display Name</label>
                                <input
                                type="text"
                                class="form-control"
                                id="display_name"
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
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Default</h5>
                    <div class="card-body">
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="defaultFormControlInput"
                          placeholder="John Doe"
                          aria-describedby="defaultFormControlHelp" />
                        <div id="defaultFormControlHelp" class="form-text">
                          We'll never share your details with anyone else.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

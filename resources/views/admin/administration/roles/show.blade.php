@extends('admin.layout.main')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
              <div class="card">
                <h5 class="card-header">Table Header & Footer</h5>
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

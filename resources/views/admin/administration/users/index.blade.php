@extends('admin.layout.main')
@section('content')
<style>
    .add-new-btn{
        position: absolute;
    right: 0px;
    padding: 30px;
}

</style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Administrator /</span> Users</h4>
        <div class="card">
            <h5 class="card-header">Users List</h5>
            <div class="add-new-btn">
                <a href="{{route('users.create')}}" >Add</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="userTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@section('js_script')
    @include('admin.administration.users.script')
@endsection

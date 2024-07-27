@extends('layout.main', [
    'title' => 'Project',
])
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Project</h4>
    @include('project.project-section')
    @include('project.project-item-list')
</div>
@endsection

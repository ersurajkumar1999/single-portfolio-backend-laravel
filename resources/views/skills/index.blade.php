@extends('layout.main', [
    'title' => 'Skills',
])
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Skills</h4>
    @include('skills.skills-section')
    @include('skills.skills-item-list')
</div>
@endsection

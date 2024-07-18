@extends('layout.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> About</h4>
    @include('about.about-section')
    @include('about.about-item-list')
</div>
@endsection

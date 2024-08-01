@extends('layout.main', [
    'title' => 'Social Media Links',
])
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Social Media Links</h4>
    @include('social-links.link-item-list')
</div>
@endsection

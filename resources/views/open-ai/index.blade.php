@extends('layout.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Open AI</h4>
    @include('open-ai.open-ai-section')
</div>
@endsection

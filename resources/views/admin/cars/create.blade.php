@extends('layouts.admin')
@section('title', 'Add Vehicle | SPM Command')
@section('content')
<div class="caps text-gold">Fleet Master Inventory Registry</div>
<h1 class="mt-2 font-display text-4xl font-extrabold uppercase">Add Exotic Vehicle</h1>
<form method="POST" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data" class="card mt-8 max-w-4xl p-6">
    @include('admin.cars._form')
</form>
@endsection

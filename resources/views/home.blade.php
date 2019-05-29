@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                Laravel 5.8 Import Export Excel to database Example
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <select class="form-control" name="group_name">
                        <option value="0">Dhaka</option>
                        <option value="1">Dinajpur</option>
                        <option value="3">Dhanmondi</option>
                        <option value="4">Srilanka</option>
                        <option value="5">Pakisthan</option>
                        <option value="6">India</option>
                        <option value="7">Rangpur</option>
                    </select>
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import User Data</button>
                    <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
                </form>
            </div>
        </div>
    </div>
@endsection

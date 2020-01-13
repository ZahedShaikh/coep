@extends('multiauth::layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ucfirst(config('multiauth.prefix')) }} Dashboard</div>

                <div class="card-body">
                    @include('multiauth::message')
                    You are logged in to {{ config('multiauth.prefix') }} side!
                </div>

                <ol class="list-group">

                    <div class="float-right">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label for="assignScholarships" class="col-md-6 col-form-label text-md-right">{{ __('Assign Scholarships') }}</label>
                            <a href="{{ route('assignScholarships') }}" class="btn btn-group-toggle btn-primary mr-3">Edit</a>
                        </li>
                    </div>


                    <div class="float-right">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label for="amountDistro" class="col-md-6 col-form-label text-md-right">{{ __('Amount Distribution') }}</label>
                            <a href="{{ route('amountDistro') }}" class="btn btn-group-toggle btn-primary mr-3">Edit</a>
                        </li>
                    </div>


                    <div class="float-right">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label for="displayStudentDetails" class="col-md-6 col-form-label text-md-right">{{ __('Display Student Details') }}</label>
                            <a href="{{ route('displayStudentDetails') }}" class="btn btn-group-toggle btn-primary mr-3">Edit</a>
                        </li>
                    </div>
                    
                    
                    <div class="float-right">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <label for="displayAll" class="col-md-6 col-form-label text-md-right">{{ __('Display All') }}</label>
                            <a href="{{ route('displayAll') }}" class="btn btn-group-toggle btn-primary mr-3">Edit</a>
                        </li>
                    </div>
                    
                    

                </ol>

            </div>
        </div>
    </div>
</div>
@endsection
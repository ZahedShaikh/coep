@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter list of student separated by comma's who are granted Scholarship</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('assignScholarships') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="student_list" class="col-md-4 col-form-label text-md-right">{{ __('Enter Students form No.') }}</label>
                            <div class="col-md-6">
                                <input id="student_list" type="text" 
                                       class="form-control @error('student_list') is-invalid @enderror" name="student_list" 
                                       autocomplete="student_list" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Assign') }}
                                </button>
                            </div>
                        </div>
                    </form>


                    <a href="javascript:history.back()" class="btn btn-primary">Back</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

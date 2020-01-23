@extends('multiauth::layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assign Scholarships</div>

                <div class="card-body">
                    @include('multiauth::message')



                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('assignamountDistro') }}">
                        @csrf

                        <div class="col-md-12">
                            <label for="student_list" class="col-md-4 col-form-label text-md-right">{{ __('Form No.') }}</label>
                            <label for="amount" class="col-md-6 col-form-label text-md-right">{{ __('Amount') }}</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="student_list1" type="text" 
                                       class="form-control @error('student_list') is-invalid @enderror" name="student_list1" 
                                       autocomplete="student_list1" autofocus>
                            </div>
                            <div class="col-md-6">
                                <input id="amount1" type="text" 
                                       class="form-control @error('student_list') is-invalid @enderror" name="amount1" 
                                       autocomplete="amount1" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="student_list2" type="text" 
                                       class="form-control @error('student_list') is-invalid @enderror" name="student_list2" 
                                       autocomplete="student_list2" autofocus>
                            </div>
                            <div class="col-md-6">
                                <input id="amount2" type="text" 
                                       class="form-control @error('student_list') is-invalid @enderror" name="amount2"
                                       autocomplete="amount2" autofocus>
                            </div>
                        </div>
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Assign') }}
                                </button>
                                <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

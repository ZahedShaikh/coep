<!--  https://www.w3adda.com/blog/laravel-5-8-jquery-ajax-form-submit !-->

@extends('multiauth::layouts.app') @section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

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


                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="filter_gender" id="filter_gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <select name="filter_country" id="filter_country" class="form-control" required>
                                    <option value="">Select Country</option>
                                    @foreach($country_name as $country)

                                    <option value="{{ $country->name }}">{{ $country->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="text-right mb-3 text-center">

                                <button type="button" name="filter" id="filter" class="btn btn-primary">
                                    {{ __('Filter') }}
                                </button>
                                <button type="button" name="reset" id="reset" class="btn btn-primary">
                                    {{ __('Reset') }}
                                </button>

                                <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>


                        <div class="col-md-4"></div>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table id="customer_data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Postal Code</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
$(document).ready(function(){

    fill_datatable();

    function fill_datatable(filter_gender = '', filter_country = '')
    {
        var dataTable = $('#customer_data').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('AllStudentDataView') }}",
                data:{filter_gender:filter_gender, filter_country:filter_country}
            },
            columns: [
                {
                    data:'CustomerName',
                    name:'CustomerName'
                },
                {
                    data:'Gender',
                    name:'Gender'
                },
                {
                    data:'Address',
                    name:'Address'
                },
                {
                    data:'City',
                    name:'City'
                },
                {
                    data:'PostalCode',
                    name:'PostalCode'
                },
                {
                    data:'Country',
                    name:'Country'
                }
            ]
        });
    }

    $('#filter').click(function(){
        var filter_gender = $('#filter_gender').val();
        var filter_country = $('#filter_country').val();

        if(filter_gender != '' &&  filter_gender != '')
        {
            $('#customer_data').DataTable().destroy();
            fill_datatable(filter_gender, filter_country);
        }
        else
        {
            alert('Select Both filter option');
        }
    });

    $('#reset').click(function(){
        $('#filter_gender').val('');
        $('#filter_country').val('');
        $('#customer_data').DataTable().destroy();
        fill_datatable();
    });

});
</script>

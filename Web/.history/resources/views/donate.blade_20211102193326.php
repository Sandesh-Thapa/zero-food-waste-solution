@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])


@section('content')
<div class="row">

    <div class="card">
        <div class="card-header">
            <h5 class="title">Donate</h5>
        </div>

        <form method="post" action="{{ route('donate.store') }}" autocomplete="off">
            <div class="card-body">
                @csrf

                <div class="form-group{{ $errors->has('total_order') ? ' has-danger' : '' }}">
                    <label>Total Order</label>
                    <input type="text" name="total_order" class="form-control{{ $errors->has('total_order') ? ' is-invalid' : '' }}" placeholder="Total Order" value="" required>
                    @include('alerts.feedback', ['field' => 'total_order'])
                </div>

                <div class="form-group{{ $errors->has('order_date') ? ' has-danger' : '' }}">
                    <label>Order Date</label>
                    <input type="date" name="order_date" class="form-control{{ $errors->has('order_date') ? ' is-invalid' : '' }}" placeholder="Order Date" value="" required>
                    @include('alerts.feedback', ['field' => 'order_date'])
                </div>
                <div class="form-group">
                    <label>Order Item</label>
                    <select name="item_id[]" multiple id="input-document_type" class="form-control form-control-alternative{{ $errors->has('item_id') ? ' is-invalid' : '' }}" required>
                        @foreach ($orderItems as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <div class="field_wrapper">
                        <div>
                            <input type="text" name="field_name[]" value=""/>
                            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Submit</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
@endpush

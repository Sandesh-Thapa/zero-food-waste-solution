@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])


@section('content')
<div class="row">

    <div class="card">
        <div class="card-header">
            <h5 class="title">Donate</h5>
        </div>

        @if (Session::has('item_accepted'))
            <h4>We can accept these items:</h4>
            @php $data = Session('item_accepted') @endphp
            <div class="alert alert-success">
                <ul>
                   @foreach ($data as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- @if (isset($item_accepted))

        <ul>
            @foreach ($item_accepted as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
        @endif --}}

        <form method="post" action="{{ route('donate.store') }}" autocomplete="off">
            <div class="card-body">
                @csrf


                <div class="form-group{{ $errors->has('order_date') ? ' has-danger' : '' }}">
                    <label>Order Date</label>
                    <input type="date" name="order_date" class="form-control{{ $errors->has('order_date') ? ' is-invalid' : '' }}" placeholder="Order Date" value="" required>
                    @include('alerts.feedback', ['field' => 'order_date'])
                </div>
                <div class="form-group">
                    <label>Order Item</label>
                    <div class="field_wrapper">
                        <div>
                            <div class="row">
                                <div class="col-sm-6 p-2">
                                    <select name="order_item[0][item_id]" id="input-document_type" class="form-control form-control-alternative{{ $errors->has('item_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($orderItems as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <input type="text" class="form-control" name="order_item[0][qty]" placeholder="Quantity 1" value=""/>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <select name="order_item[1][item_id]" id="input-document_type" class="form-control form-control-alternative{{ $errors->has('item_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($orderItems as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <input type="text" class="form-control" name="order_item[1][qty]" placeholder="Quantity 1"  value=""/>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <select name="order_item[2][item_id]" id="input-document_type" class="form-control form-control-alternative{{ $errors->has('item_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($orderItems as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <input type="text"  class="form-control" name="order_item[2][qty]" placeholder="Quantity 3" value=""/>
                                </div>
                                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Donate</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
// $(document).ready(function(){
//      var i = 0;
//     var maxField = 10; //Input fields increment limitation
//     var addButton = $('.add_button'); //Add button selector
//     var wrapper = $('.field_wrapper'); //Input field wrapper
//     var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt"></i></a></div>'; //New input field html
//     var x = 1; //Initial field counter is 1

//     //Once add button is clicked
//     $(addButton).click(function(){
//         ++i;
//         //Check maximum number of input fields
//         if(x < maxField){
//             x++; //Increment field counter
//             $(wrapper).append('<div><select name="field_name['+i+'][name]"><option value="1">here</option></select><input type="text" name="field_name['+i+'][qty]" value=""/><a href="javascript:void(0);" class="remove_button"><i class="fas fa-trash-alt"></i></a></div>'); //Add field html
//         }
//     });

//     //Once remove button is clicked
//     $(wrapper).on('click', '.remove_button', function(e){
//         e.preventDefault();
//         $(this).parent('div').remove(); //Remove field html
//         x--; //Decrement field counter
//     });
// });

//  var i = 0;

//     $("#add").click(function(){

//         ++i;

//         $("#dynamicTable").append('<input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /><button type="button" class="btn btn-danger remove-tr">Remove</button>');
//     });

//     $(document).on('click', '.remove-tr', function(){
//          $(this).parents('tr').remove();
//     });
</script>
@endpush

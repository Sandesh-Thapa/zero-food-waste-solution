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
                    <select name="item_id" id="input-document_type" class="form-control form-control-alternative{{ $errors->has('item_id') ? ' is-invalid' : '' }}" required>
                            {{-- @foreach ($item as $orderItems)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach --}}
                        </select>
                    {{-- <input type="text" name="order_item" class="form-control" placeholder="Order Item" value="" required> --}}
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

@endpush

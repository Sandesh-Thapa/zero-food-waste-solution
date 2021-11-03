@extends('layouts.app', ['pageSlug' => 'dashboard', 'page' => 'Dashboard', 'section' => ''])

@section('content')
<div class="row">

    <div class="card">
        <div class="card-header">
            <h5 class="title">Donate</h5>
        </div>

        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
            <div class="card-body">
                @csrf

                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <label>Total Order</label>
                    <input type="text" name="total_order" class="form-control{{ $errors->has('total_order') ? ' is-invalid' : '' }}" placeholder="Total Order" value="" required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="New password" value="" required>
                    @include('alerts.feedback', ['field' => 'password'])
                </div>
                <div class="form-group">
                    <label>Confirm new password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" value="" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-fill btn-primary">Change Password</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('js')

@endpush

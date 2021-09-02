@extends('layouts.app')
@section('content')

<div class="col-5">
    <div class="card">
        <div class="card-header">
            <h3  class="card-title"> Reset Password</h3>
        </div>
        <div class="card-body">
            <form id="form-password">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
    
            </form>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="form-password" class="btn btn-primary">Save</button>
              </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/auth.js') }}"></script>
@endsection
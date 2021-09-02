@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3  class="card-title"> User</h3>
        <div class="card-tools"> 
            <button class="btn bt-sm btn-info float-right created">Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="user" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="form-user">

              <input type="hidden" id="id" name="id">

              <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" name="name" id="name" class="form-control">
              </div>

              <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" name="username" id="username" class="form-control">
              </div>

              <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" id="password" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Role</label>
                <select name="role" class="form-control" id="role">
                  <option value="">Pilih</option>
                  <option value="A">Admin</option>
                  <option value="G">Guest</option>
                </select>
              </div>
              
             <div class="form-group">
                <label for="">Status </label>
                <select name="status" class="form-control" id="status">
                  <option value="">Pilih</option>
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
              </div>
              
              
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="form-user" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    <script src="{{ asset('assets/admin/user.js') }}"></script>
@endsection
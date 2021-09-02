@extends('layouts.app')
@section('content')


<div class="card">
    <div class="card-header">
        <h3  class="card-title">Creator Books</h3>
        <div class="card-tools"> 
            <button class="btn bt-sm btn-info float-right created">Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="creatorbooks" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-creator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Creator Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-creator">
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                  <label for="">Nama Creator</label>
                  <input type="text" name="name" id="name" class="form-control">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="form-creator" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    <script src="{{ asset('assets/admin/creator_book.js') }}"></script>
@endsection
@extends('layouts.app')
@section('content')


<div class="card">
    <div class="card-header">
        <h3  class="card-title"> Books</h3>
        <div class="card-tools"> 
            <button class="btn bt-sm btn-info float-right created">Create</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="books" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Creator</th>
                        <th>Judul</th>
                        <th>Tahun Rilis</th>
                        <th>Status Buku</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-book" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-book">
              <input type="hidden" id="id" name="id">

              <div class="form-group">
                  <label for="">Nama Creator</label>
                  <select name="creator_id" class="form-control" id="creator_id">
                    <option value="">Pilih</option>
                    @foreach ($creator as $res)
                        <option value="{{ $res->id }}">{{ $res->name }}</option>
                    @endforeach
                  </select>
              </div>

              
              <div class="form-group">
                <label for="">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control">
              </div>

              <div class="form-group">
                <label for="">Tahun Rilis</label>
                
              <select name="publication_year" id="publication_year" class="form-control">
                <option value="">Pilih</option>
                @for ($year = (int)date('Y'); 1900 <= $year; $year--)
                  <option value="{{ $year }}">{{ $year }}</option>
                @endfor
              
              </select>
             </div>

             <div class="form-group">
              <label for="">Status Buku</label>
              <select name="status" class="form-control" id="status">
                <option value="">Pilih</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Foto Buku</label>
              <input type="file" name="foto" id="foto" class="form-control">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" form="form-book" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    <script src="{{ asset('assets/admin/books.js') }}"></script>
@endsection
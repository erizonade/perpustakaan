@extends('layouts.app')
@section('content')
<div class="row">
      <div class="form-group mx-sm-3 mb-2">
        <input type="text" name="judul_buku" id="judul_buku" title="Silakan Cari" placeholder="Silakan Cari" class="form-control ">
      </div>
      <button type="submit" class="btn btn-success mb-2 judul_buku">Search</button> &nbsp;
      
      <button type="reset" class="btn btn-primary mb-2" onclick="window.location.reload()">Refresh</button>
</div>
<div class="col-12">    

    <div class="row">
        <div class="card-deck" id="books-filter">
            @foreach ($book as $res)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('/data/images/'.$res->foto) }}" width="277px" height="200px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td><b>Judul Buku</b></td>
                                <td> : </td>
                                <td><b>{{ $res->title }}</b></td>
                            </tr>
                            <tr>
                                <td>Tahun Rilis</td>
                                <td> : </td>
                                <td>{{ $res->publication_year }}</td>
                            </tr>
                            <tr>
                                <td>Creator</td>
                                <td> : </td>
                                <td>{{ $res->name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>                
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('assets/guest/book_filter.js') }}"></script>
@endsection
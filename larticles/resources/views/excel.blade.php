@extends('main') @section('title', 'Street detail page') @section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>
                    Users
                </h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>straatname</th>
                                        <th>aantal</th>
                                
                                    </tr>
                                </thead>
                      
                                <tbody>
                                @foreach($articles as $article)
                                    <tr >
                                        <td>{{ $article->extend }}</td>
                                        <td>{{$article->total}}</td>
                                    
                         
                               
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
        @endsection
@section('script')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ URL::asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('/js/pages/tables/jquery-datatable.js') }}"></script>
    



   
@endsection

  

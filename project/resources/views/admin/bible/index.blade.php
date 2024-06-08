@extends('layouts.admin')

@section('title')
   @lang('Bible')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header">
        <h1>@lang('Bible')</h1>
    </div>
</section>
@endsection

@section('content')


<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
               <i class="fas fa-plus"></i> @lang('Add New')
             </button>

         </div>
         <div class="table-responsive p-3">
            <table class="table table-striped">
               <tr>
                   <th>@lang('Genesis')</th>
                   <th>@lang('Text')</th>
                   <th class="text-right">@lang('Action')</th>
               </tr>
               @forelse ($bibles as $item)
                   <tr>

                        <td data-label="@lang('Genesis')">
                          gen-{{$item->genesis}}
                        </td>
                        <td data-label="@lang('Slug')">
                          {{$item->text}}
                        </td>

                        <td data-label="@lang('Action')" class="text-right">
                           <a href="javascript:void()" class="btn btn-primary approve btn-sm edit mb-1" data-route="{{route('admin.genesis.update',$item->id)}}" data-item="{{$item}}" data-toggle="tooltip" title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                           <a href="javascript:void(0)" class="btn btn-danger btn-sm remove mb-1" data-id="{{$item->id}}"  data-toggle="tooltip" title="@lang('Remove')"><i class="fas fa-trash"></i></a>
                        </td>
                   </tr>
                @empty

                   <tr>
                       <td class="text-center" colspan="100%">@lang('No Data Found')</td>
                   </tr>

               @endforelse
           </table>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.genesis.store')}}" method="POST">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@lang('Add new Bible Text')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>@lang('Text')</label>
                    <textarea class="form-control" name="text" rows="5">@lang('Bible text')</textarea>
               </div>
               <div class="form-group">
                  <label>@lang('Genesis')</label>
                  <select name="genesis" class="form-control">
                     <option value="1">@lang('Gen-1')</option>
                     <option value="2">@lang('Gen-2')</option>
                     <option value="3">@lang('Gen-3')</option>
                     <option value="4">@lang('Gen-4')</option>
                     <option value="5">@lang('Gen-5')</option>
                     <option value="6">@lang('Gen-6')</option>
                     <option value="7">@lang('Gen-7')</option>
                     <option value="8">@lang('Gen-8')</option>
                     <option value="9">@lang('Gen-9')</option>
                     <option value="10">@lang('Gen-10')</option>
                     <option value="11">@lang('Gen-11')</option>
                     <option value="12">@lang('Gen-12')</option>
                     <option value="13">@lang('Gen-13')</option>
                     <option value="14">@lang('Gen-14')</option>
                     <option value="15">@lang('Gen-15')</option>
                     <option value="16">@lang('Gen-16')</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>
         </div>
      </form>
   </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <form action="" method="POST">
         @csrf
         @method('PUT')
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">@lang('Edit category')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>@lang('Text')</label>
                <textarea class="form-control" name="text" rows="5">@lang('Bible text')</textarea>
               </div>
               <div class="form-group">
                  <label>@lang('Genesis')</label>
                  <select name="genesis" class="form-control">
                    <option value="1">@lang('Gen-1')</option>
                    <option value="2">@lang('Gen-2')</option>
                    <option value="3">@lang('Gen-3')</option>
                    <option value="4">@lang('Gen-4')</option>
                    <option value="5">@lang('Gen-5')</option>
                    <option value="6">@lang('Gen-6')</option>
                    <option value="7">@lang('Gen-7')</option>
                    <option value="8">@lang('Gen-8')</option>
                    <option value="9">@lang('Gen-9')</option>
                    <option value="10">@lang('Gen-10')</option>
                    <option value="11">@lang('Gen-11')</option>
                    <option value="12">@lang('Gen-12')</option>
                    <option value="13">@lang('Gen-13')</option>
                    <option value="14">@lang('Gen-14')</option>
                    <option value="15">@lang('Gen-15')</option>
                    <option value="16">@lang('Gen-16')</option>
                 </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>
         </div>
      </form>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="removeMod" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <form action="{{route('admin.genesis.destroy')}}" method="POST">
         @method('DELETE')
         @csrf
         <input type="hidden" name="id">
         <div class="modal-content">
            <div class="modal-body">
               <h5>@lang('Are you sure to remove?')</h5>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
               <button type="submit" class="btn btn-danger">@lang('Confirm')</button>
            </div>
         </div>
      </form>
   </div>
</div>

@endsection

@push('script')
    <script>
       'use strict';
       $('.edit').on('click',function () { 
            var item = $(this).data('item')
            var route = $(this).data('route')
            $('#edit').find('textarea[name=text]').val(item.text)
            $('#edit').find('select[name=genesis]').val(item.genesis)
            $('#edit').attr('action',route)
            $('#edit').modal('show')
          
       })

       $('.remove').on('click',function () { 
         $('#removeMod').find('input[name=id]').val($(this).data('id'))
         $('#removeMod').modal('show')
       })
    </script>
@endpush


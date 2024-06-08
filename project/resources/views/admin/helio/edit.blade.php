@extends('layouts.admin')
@section('title')
   @lang('Add New Helio')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@lang('Add New video')</h1>
        <a href="{{route('admin.helio.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back')</a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New heliopolis Form') }}</h6>
         </div>
         <div class="card-body">
           
            <form action="{{route('admin.helio.update',$helio->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-12 ShowImage mb-3  text-center {{ $helio->is_video== 0 ? 'd-none' : '' }} " id="is_image">
                    <img src="{{ getPhoto($helio->image) }}" class="img-fluid" alt="image" width="400">
                 </div>
                
                <div class="form-group" >
                    <label for="title">{{ __(' Title') }}</label>
                    <input type="text" class="form-control" name="title" id="title" required placeholder="{{ __('video Title') }}" value="{{$helio->title}}">
                </div>
                
                <div class="form-group" >
                        <label>{{ __('Is Video') }}</label>
                        <select class="form-control  mb-3"  name="is_video" id="is_video" required>
                            <option {{ $helio->is_video== 1 ? 'selected' : '' }} value="1">{{__('Video')}}</option>
                            <option {{ $helio->is_video== 0 ? 'selected' : '' }} value="0">{{__('Image')}}</option>
                        </select>
                    </div>
            
                <div class="form-group {{ $helio->is_video== 0 ? 'd-none' : '' }}" id="video">
                    <label for="video">{{ __('video Link') }}</label>
                    <input type="text" class="form-control" name="video" id="video" required placeholder="{{ __('video Link') }}" value="{{$helio->video}}">
                    <small>Please use embed link from youtube</small>
                </div>
                
                 <div class="col-md-6 {{ $helio->is_video== 1 ? 'd-none' : '' }}" id="image">
                        <div class="form-group">
                            <label for="image">{{ __('Blog Photo') }}</label>
                            <span class="ml-3">{{ __('(Extension:jpeg,jpg,png)') }}</span>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo" id="image" accept="image/*" >
                                <label class="custom-file-label" for="photo">{{ __('Choose file') }}</label>
                            </div>
                        </div>
                    </div>
                
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="area1" class="form-control summernote" name="description" placeholder="{{ __('Description') }}" >

                        {!! $helio->description !!}
                    
                    </textarea>
                </div>
                
                 

                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select class="form-control  mb-3"  name="status" required>
                            <option value="1">{{__('Active')}}</option>
                            <option value="0">{{__('Inactive')}}</option>
                        </select>
                    </div>        
              
           
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
      <!-- Form Sizing -->
      <!-- Horizontal Form -->
   </div>
</div>
<!--Row-->
@endsection

@push('script')

<script>

$('#is_video').on('change',function(){
    var is_video = $(this).val();
    if(is_video == 1){
        $('#video').removeClass('d-none');
        $('#image').addClass('d-none');
        $('#is_image').addClass('d-none');
    }else{
        $('#video').addClass('d-none');
        $('#image').removeClass('d-none');
        $('#is_image').removeClass('d-none');
    }
});


</script>

@endpush


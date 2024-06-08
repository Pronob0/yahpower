@extends('layouts.admin')
@section('title')
   @lang('Edit video')
@endsection

@section('breadcrumb')
 <section class="section">
    <div class="section-header  d-flex justify-content-between">
        <h1>@lang('Edit video')</h1>
        <a href="{{route('admin.video.index')}}" class="btn btn-primary"><i class="fas fa-backward"></i> @lang('Back')</a>
    </div>
</section>
@endsection
@section('content')

<div class="row justify-content-center">
   <div class="col-md-12">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit video Form') }}</h6>
         </div>
         <div class="card-body">
           
            <form action="{{route('admin.video.update',$video->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">{{ __('video Title') }}</label>
                    <input type="text" class="form-control" name="title" id="title" required placeholder="{{ __('video Title') }}" value="{{$video->title}}">
                </div>
            
                <div class="form-group">
                    <label for="video">{{ __('video Link') }}</label>
                    <input type="text" class="form-control" name="video" id="video" required placeholder="{{ __('video Link') }}" value="{{$video->video}}">
                    <small>Please use embed link from youtube</small>
                </div>
                
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea id="area1" class="form-control summernote" name="description" placeholder="{{ __('Description') }}" >{{$video->description}}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ __('Status') }}</label>
                    <select class="form-control  mb-3"  name="status" required>
                        <option value="1" {{$video->status == 1 ? 'selected':''}}>{{__('Active')}}</option>
                        <option value="0" {{$video->status == 0 ? 'selected':''}}>{{__('Inactive')}}</option>
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


</script>

@endpush


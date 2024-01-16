@extends('layouts.app')

@section('title', $title)
@push('styles')

<style>
    .ace_editor{
        height: 200px;
    }
    .close-btn{
        background: #ff0854;
        color: #fff;
        height: 30px;
        width: 30px;
        border-radius: 50%;
    }
    .add-column-link {
        border: 0;
        background: transparent;
        color: #0033c4;
        font-size: 14px;
        font-weight: 600;
    }
    .add-column-link:hover{
        text-decoration: underline
    }
    .w-90{
        width: 95%;
    }
    .table-column-box table tr td{
        padding-bottom: 10px;
    }
    .custom-checkbox-design{
        height: 200px;
        overflow: auto;
    }
</style>
@endpush

@section('content')
    <!-- row opened -->
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12 mx-auto">
            <form method="POST" action="{{ isset($post) ? route('super.pages.update', $post->id) : route('super.pages.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($post)
                    @method('PUT')
                    <input type="hidden" name="update_id"  value="{{ $post->id }}">
                @endisset
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <h4 class="card-title">
                                Post
                            </h4>
                            <div class="card-body">
                                <div class="col-12">
                                    <x-form.textbox name="name" labelName="Name" required="required" errorInput="name" value="{{ $post->name ?? old('name') }}"></x-form.textbox>
                                </div>
                                @isset($post)
                                <div class="col-12">
                                    <x-form.textarea name="slug" labelName="Slug" required="required" errorInput="slug" value="{{ $post->slug }}"></x-form.textarea>
                                </div>
                                @endisset
                                <div class="col-12">
                                    <x-form.textarea name="content" labelName="Content" class="m-editor" required="required" errorInput="content" value="{!! isset($post) ? $post->content : old('content') !!}"></x-form.textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <x-form.publish name="status" labelName="Status" class="select-search-hide" errorInput="status" required="required">
                                        <option value="">-- Select Status --</option>
                                        @foreach (STATUS as $key=>$value)
                                            <option value="{{ $key }}" @isset($post)
                                                {{ $post->status == $key ? 'selected' : '' }}
                                            @endisset>{{ $value }}
                                            </option>
                                        @endforeach
                                    </x-form.publish>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="facebook" class="required label-text">Feature Image</label>
                                        <div id="feature_image">

                                        </div>
                                        <input type="hidden" name="old_feature_image" value="{{ isset($post) ? $post->feature_image  : ''  }}">

                                        @error('feature_image')
                                            <span class="text-danger"><i class="far fa-times-circle fa-sm"></i>
                                            {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" id="save_btn" class="btn rounded-0 btn-sm btn-primary mb-0">
                                        @isset($post)
                                            Update
                                        @else
                                            Create
                                        @endisset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /row -->

@endsection

@push('scripts')
   <script>
        $('#feature_image').spartanMultiImagePicker({
            fieldName: 'feature_image',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-12 com-sm-12 com-xs-12 mb-0 p-0',
            maxFileSize: '',
            dropFileLabel: 'Drop Here',
            allowExt: 'png|jpg|jpeg',
            onExtensionErr: function (index, file) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Only png, jpg and jpeg file format allowed!'
                });
            }
        });

        @if(isset($post))
            $('#feature_image img.spartan_image_placeholder').css('display','none');
            $('#feature_image .spartan_remove_row').css('display','none');
            $('#feature_image .img_').css('display','block');
            $('#feature_image .img_').attr('src','{{ asset($post->feature_image) }}');
        @endif

   </script>
@endpush

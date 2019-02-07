{{-- Delete Image associated with this record --}}

@section('deleteImageBlock')
	{{-- Icons and Text --}}
	@if($model->user->actionButtons == 1)
		<i class="glyphicon glyphicon-trash"></i> Delete Image
	@endif

	{{-- Icons Only --}}
	@if($model->user->actionButtons == 2)
		<i class="glyphicon glyphicon-trash"></i>
	@endif

	{{-- Text Only --}}
	@if($model->user->actionButtons == 3)
		Delete Image
	@endif
@stop


	@if (Auth::user()->id == $model->user_id)
		@ability('admin', 'admin,'.$primer.'_delete,'.$primer.'_delete_admin')
			{{-- @include('includes.frontend.buttons._deleteImage') --}}
			<button type="button" class="btn btn-primary btn-lg"
				data-toggle="modal"
				data-target="#confirmDeleteImage"
				data-id="{{ $model->id }}"
				data-target="#confirmDelete"
				data-title="Delete image?"
				data-message="Are you sure you want to delete this image222222?"
				>TEST</button>
			{{-- <form method="POST" action="{{ route($section_name.'.deleteImage', $model->id) }}" accept-charset="UTF-8" style="display:inline">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button
					class="btn btn-xs btn-warning"
					{{ $model->user->actionButtons == 2 ? 'title=Delete' : '' }}
					type="button"
					data-toggle="modal"
					data-id="{{ $model->id }}"
					data-target="#confirmDelete"
					data-title="Delete image?"
					data-message="Are you sure you want to delete this image1111111?">
					
					@yield('deleteImageBlock')
				</button>
			</form> --}}
		@endability
	@else
		@ability('admin', 'admin,'.$primer.'_delete_admin')
			{{-- @include('includes.frontend.buttons._deleteImage') --}}
			<button type="button" class="btn btn-primary btn-xs"
				data-toggle="modal"
				data-target="#confirmDeleteImage"
				data-id="{{ $model->id }}"
				data-target="#confirmDelete"
				data-title="Delete image?"
				data-message="Are you sure you want to delete this image222222?"
				>Delete Iamge</button>
			{{-- <form method="POST" action="{{ route($section_name.'.deleteImage', $model->id) }}" accept-charset="UTF-8" style="display:inline">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button
					class="btn btn-xs btn-warning"
					{{ $model->user->actionButtons == 2 ? 'title=Delete' : '' }}
					type="button"
					data-toggle="modal"
					data-id="{{ $model->id }}"
					data-target="#confirmDelete"
					data-title="Delete image?"
					data-message="Are you sure you want to delete this image222222?">
					
					@yield('deleteImageBlock')
				</button>
			</form> --}}
		@endability
	@endif


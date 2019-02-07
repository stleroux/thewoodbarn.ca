{{-- Delete record --}}

@if (Auth::user()->id == $model->user_id)

	@ability('admin', 'admin,'.$primer.'_delete,'.$primer.'_delete_admin')
		<form method="POST" action="{{ route('admin.'.$section_name.'.destroy', $model->id) }}" accept-charset="UTF-8" style="display:inline">
			<input type="hidden" name="_method" value="DELETE">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button
				class="btn btn-xs btn-danger"
				{{ $model->user->actionButtons == 2 ? 'title=Delete' : '' }}
				type="button"
				data-toggle="modal"
				data-id="{{ $model->id }}"
				data-target="#confirmDelete"
				data-title="Delete {{ str_singular(ucfirst($section_name)) }}"
				data-message="Are you sure you want to delete this {{ str_singular($section_name) }}?">
					
					{{-- Icons and Text --}}
					@if($model->user->actionButtons == 1)
						<i class="glyphicon glyphicon-trash"></i> Delete
					@endif

					{{-- Icons Only --}}
					@if($model->user->actionButtons == 2)
						<i class="glyphicon glyphicon-trash"></i>
					@endif

					{{-- Text Only --}}
					@if($model->user->actionButtons == 3)
						Delete
					@endif

			</button>
		</form>
	@endability

@else

	@ability('admin', 'admin,'.$primer.'_delete_admin')
		<form method="POST" action="{{ route('admin.'.$section_name.'.destroy', $model->id) }}" accept-charset="UTF-8" style="display:inline">
			<input type="hidden" name="_method" value="DELETE">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button
				class="btn btn-xs btn-danger"
				{{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
				type="button"
				data-toggle="modal"
				data-id="{{ $model->id }}"
				data-target="#confirmDelete"
				data-title="Delete {{ str_singular(ucfirst($section_name)) }}"
				data-message="Are you sure you want to delete this {{ str_singular($section_name) }}?">
					
					{{-- Icons and Text --}}
					@if(Auth::user()->actionButtons == 1)
						<i class="glyphicon glyphicon-trash"></i> Delete
					@endif

					{{-- Icons Only --}}
					@if(Auth::user()->actionButtons == 2)
						<i class="glyphicon glyphicon-trash"></i>
					@endif

					{{-- Text Only --}}
					@if(Auth::user()->actionButtons == 3)
						Delete
					@endif
					
			</button>
		</form>
	@endability

@endif

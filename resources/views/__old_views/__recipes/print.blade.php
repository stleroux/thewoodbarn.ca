@extends ('layouts.print')

@section ('title', 'View Recipe')

@section ('content')

<table class="table">
	<tr>
		<th colspan="12" bgcolor="#c0c0c0">From the Recipe Book at TheWoodBarn.ca</th>
	</tr>
	<tr>
		<th colspan="12">{{ ucwords($recipe->title) }}</th>
	</tr>
	<tr>
		<th colspan="6">Ingredients</th>
		<th colspan="3">Image</th>
		<th colspan="3">Information</th>
	</tr>
	<tr>
		<td colspan="6">
			{!! $ingredients = str_replace(array('<p>','</p>'),array('','<br />'),$recipe->ingredients) !!}
			<br />
		</td>
		<td colspan="3">
			@if ($recipe->image)
				{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'200','width'=>'200')) }}
			@endif
		</td>
		<td colspan="3">
			<table width="100%">
				<tr>
					<th>Category</th>
				</tr>
				<tr>
					<td>{{ $recipe->category->name }}</td>
				</tr>
				<tr>
					<th>Servings</th>
				</tr>
				<tr>
					<td>{{ $recipe->servings }}</td>
				</tr>
				<tr>
					<th>Prep Time</th>
				</tr>
				<tr>
					<td>{{ $recipe->prep_time }}</td>
				</tr>
				<tr>
					<th>Cook Time</th>
				</tr>
				<tr>
					<td>{{ $recipe->cook_time }}</td>
				</tr>
				<tr>
					<th>Created By</th>
				</tr>
				<tr>
					<td>{{ $recipe->user->first_name }} {{ $recipe->user->last_name }}</td>
				</tr>
				<tr>
					<th>Created On</th>
				</tr>
				<tr>				
					<td>@include('partials._dateFormat', ['dateFormat'=>Auth::user()->dateFormat, 'model'=>$recipe, 'field'=>'created_at'])</td>
				</tr>
				<tr>
					<th>Source</th>
				</tr>
				<tr>
					<td>
						@if ($recipe->source)
							{{ $recipe->source }}
						@else
							N/A
						@endif
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th colspan="12">Methodology</th>
	</tr>
	<tr>
		<td colspan="12">{!! $recipe->methodology !!}</td>
	</tr>
	<tr>
		<th colspan="12">Author's Notes</th>
	</tr>
	<tr>
		<td colspan="12">
			@if ($recipe->public_notes) 
				{!! $recipe->public_notes !!}
			@else
				N/A
			@endif
		</td>
	</tr>
</table>

@stop
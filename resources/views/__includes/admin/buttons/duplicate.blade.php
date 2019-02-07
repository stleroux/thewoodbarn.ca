{{-- Duplicate record --}}
@@php
  $smodel = str_singular($model);
  dd($smodel);
@endphp

@if (Auth::user()->id == $uid)
  @ability('admin', 'admin,'.$model.'_create,'.$model.'_create_admin')
    <a href="{{ route('admin.'.$model.'.duplicate', $$smodel->id) }}" class="btn btn-default btn-xs" {{ $article->user->actionButtons == 2 ? 'title=Duplicate' : '' }}>
      @if(Auth::user()->actionButtons == 1)
        {{-- Icons and Text --}}<i class="glyphicon glyphicon-duplicate"></i> Duplicate 1
      @elseif(Auth::user()->actionButtons == 2)
        {{-- Icons Only --}}<i class="glyphicon glyphicon-duplicate"></i>
      @elseif(Auth::user()->actionButtons == 3)
        {{-- Text Only --}}Duplicate
      @endif
    </a>
  @endability
@else
  @ability('admin', 'admin,'.$model.'_create')
    <a href="{{ route('admin.articles.duplicate', $article->id) }}" class="btn btn-default btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Duplicate' : '' }}>
      @if(Auth::user()->actionButtons == 1)
        {{-- Icons and Text --}}<i class="glyphicon glyphicon-duplicate"></i> Duplicate 2
      @elseif(Auth::user()->actionButtons == 2)
        {{-- Icons Only --}}<i class="glyphicon glyphicon-duplicate"></i>
      @elseif(Auth::user()->actionButtons == 3)
        {{-- Text Only --}}Duplicate
      @endif
    </a>
  @endability
@endif

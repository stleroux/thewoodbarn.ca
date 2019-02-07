<a href="{{ route('admin.'.$model.'.index') }}" class="btn btn-default btn-xs btn-block">
  <div class="text text-left">
    @if(Auth::user()->actionButtons == 1)
      {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
    @elseif(Auth::user()->actionButtons == 2)
      {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
    @elseif(Auth::user()->actionButtons == 3)
      {{-- Text Only --}}Cancel
    @endif
  </div>
</a>
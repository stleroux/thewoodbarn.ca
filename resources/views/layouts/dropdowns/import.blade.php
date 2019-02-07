{{--================================================================================================================================--}}
{{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
{{--================================================================================================================================--}}
{{-- @if (checkACL('publisher')) --}}
<!-- Split button -->
<div class="btn-group">
  {{-- <button type="button" class="btn btn-danger">Import / Export</button> --}}
  <a href="{{ route($name.'.import') }}" class="btn btn-xs btn-default"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Import / Export</a>
  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li>
      <a href="{{ URL::to($name.'/downloadExcel/xls') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS
        @else
          Download as XLS
        @endif
      </a>
    </li>
    <li>
      <a href="{{ URL::to($name.'/downloadExcel/xlsx') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX
        @else
          Download as XLSX
        @endif
      </a>
    </li>
    <li>
      <a href="{{ URL::to($name.'/downloadExcel/csv') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as CSV
        @else
          Download as CSV
        @endif
      </a>
    </li>
    <li role="separator" class="divider"></li>
    <li>
      {{-- <a href="{{ URL::to($name.'/exportPDF') }}"> --}}
      <a href="{{ route('items.exportPDF') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF
        @else
          Export to PDF
        @endif
      </a>
    </li>
  </ul>
</div>
{{-- @endif --}}
{{-- 
  <div class="btn-group">
    @if(Auth::user()->actionButtons == 1)
      <a href="{{ route($name.'.import') }}" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-refresh" aria-hidden="true"></i>
        Import / Export <span class="caret"></span>
      </a>
    @elseif(Auth::user()->actionButtons == 2)
      <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-refresh fa-2x" aria-hidden="true" style="vertical-align: middle;"></i>
        <span class="caret"></span>
      </button>
    @elseif(Auth::user()->actionButtons == 3)
      <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Import / Export 
        <span class="caret"></span>
      </button>
    @endif

    <ul class="dropdown-menu">
      <li><a href="{{ route($name.'.import') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-upload" aria-hidden="true"></i> Import Data</a>
        @else
          Import Data</a>
        @endif
      </li>
      
      <li role="separator" class="divider"></li>
      
      <li>
        <a href="{{ URL::to($name.'/downloadExcel/xls') }}">
          @if(Auth::user()->actionButtons <= 2)
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS
          @else
            Download as XLS
          @endif
        </a>
      </li>

      <li><a href="{{ URL::to($name.'/downloadExcel/xlsx') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a>
        @else
          Download as XLSX
        @endif
      </li>

      <li><a href="{{ URL::to($name.'/downloadExcel/csv') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as CSV</a>
        @else
          Download as CSV
        @endif
      </li>

      <li role="separator" class="divider"></li>
      
      <li><a href="{{ URL::to($name.'/exportPDF') }}">
        @if(Auth::user()->actionButtons <= 2)
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a>
        @else
          Export to PDF
        @endif
      </li>
    </ul>
  </div> --}}


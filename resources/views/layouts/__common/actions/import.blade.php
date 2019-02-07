{{--================================================================================================================================--}}
{{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
{{--================================================================================================================================--}}
@if (checkACL('publisher'))
  <div class="btn-group">
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-refresh" aria-hidden="true"></i>
      Import / Export <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="{{ route($name.'.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="{{ URL::to($name.'/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
      <li><a href="{{ URL::to($name.'/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
      <li><a href="{{ URL::to($name.'/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="{{ URL::to($name.'/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
    </ul>
  </div>
@endif
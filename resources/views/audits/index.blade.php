{{-- http://bootsnipp.com/snippets/featured/panel-tables-with-filter --}}
@extends('layouts.main')

@section('title','')

@section('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Audits</li>
@stop

@section('menubar')
      <!-- Only show the Dashboard button if coming from the Dashboard page -->
      @if (false !== stripos($_SERVER['HTTP_REFERER'], "/dashboard"))
        <a href="{{ URL::previous() }}" class="btn btn-xs btn-default">
          <div class="text text-left">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            Dashboard
          </div>
        </a>
      @endif
@stop

@section('content')
  <div class="panel panel-primary filterable">
    <div class="panel-heading btn-filter">

      <h3 class="panel-title"><i class="fa fa-headphones" aria-hidden="true"></i> Audits</h3>
      <div class="pull-right"><span class="glyphicon glyphicon-filter"></span></div>
    </div>
    <div class="panel-body">
      <table class="table table-responsive table-hover table-condensed">
        <thead>
          <tr class="filters">
            <th><input type="text" class="form-control" size="04" placeholder="#" disabled></th>
            <th><input type="text" class="form-control" placeholder="Username" disabled></th>
            <th><input type="text" class="form-control" placeholder="Event" disabled></th>
            <th><input type="text" class="form-control" placeholder="URL" disabled></th>
            <th><input type="text" class="form-control" placeholder="Auditable Type" disabled></th>
            <th><input type="text" class="form-control" placeholder="Auditable ID" disabled></th>           
            <th><input type="text" class="form-control" placeholder="IP Address" disabled></th>
            <th><input type="text" class="form-control" placeholder="Create date" disabled></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($audits as $audit)
            <tr>
              <td>{{ $audit->id }}</td>
              <td>{{ $audit->user->username}}</td>
              <td>{{ $audit->event }}</td>
              <td>{{ substr($audit->url, 22) }}</td>
              <td>{{ $audit->auditable_type }}</td>
              <td>{{ $audit->auditable_id }}</td>
              <td>{{ $audit->ip_address }}</td>
              <td>{{ $audit->created_at->format('d M Y') }}</td>
              <td>
                <a href="" data-toggle="modal" data-target="#detailsModal{{$audit->id}}">Details</a>
              </td>
            </tr>

            {{-- DETAILS MODAL BEGIN --}}
            <div class="modal fade" id="detailsModal{{$audit->id}}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="printPostModalLabel">Details</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel panel-default panel-borderless">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-xs-1 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>#</b></div>
                          <div class="col-xs-2 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Username</b></div>
                          <div class="col-xs-2 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Event</b></div>
                          <div class="col-xs-2 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Audit Type</b></div>
                          <div class="col-xs-5 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Audit ID</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-1">{{ $audit->id }}</div>
                          <div class="col-xs-2">{{ $audit->user->username }}</div>
                          <div class="col-xs-2">{{ ucfirst($audit->event) }}</div>
                          <div class="col-xs-2">{{ $audit->auditable_type }}</div>
                          <div class="col-xs-5">{{ $audit->auditable_id }}</div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-xs-8 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>URL</b></div>
                          <div class="col-xs-4 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>IP Address</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-8">{{ $audit->url }}</div>
                          <div class="col-xs-4">{{ $audit->ip_address }}</div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>User Agent</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">{{ $audit->user_agent }}</div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-xs-12 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Old Values</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            @foreach (json_decode($audit->old_values) as $okey => $ovalue)
                              <div class="row">
                                <div class="col-xs-2"><b>{{ $okey }}</b></div>
                                <div class="col-xs-10">{{ $ovalue }}</div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-xs-12 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>New Values</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12">
                            @foreach (json_decode($audit->new_values) as $nkey => $nvalue)
                              <div class="row">
                                {{-- <div class="col-xs-2"><b>{{ $nkey }}</b></div> --}}
                                {{-- <div class="col-xs-10">{{ $nvalue }}</div> --}}
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <br />
                        <div class="row">
                          <div class="col-xs-3 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Create Date</b></div>
                          <div class="col-xs-9 {{ ($audit->event == 'deleted') ? 'bg-danger' : 'bg-info' }}"><b>Update Date</b></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-3">{{ $audit->created_at }}</div>
                          <div class="col-xs-9">{{ $audit->updated_at }}</div>
                        </div>
                      </div>
                    </div>
                      </div>
                      <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- DETAILS MODAL END --}}

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop

@section('scripts')
  {{-- Filters --}}
  <script type="text/javascript">
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });

    });
  </script>
@stop

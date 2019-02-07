{{-- USER MODAL --}}
<div class="modal fade" id="userModal{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="userModalLabel">User Profile (ALL)</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                  <div class="panel-heading"><b>User Profile</b> :: {{ $model->user->first_name }} {{ $model->user->last_name }}</div>
                  <div class="panel-body">
                      <div class="col-md-8">
                          <div class="panel panel-default">
                              <div class="panel-heading">Personal Info</div>
                              <div class="panel-body">
                                  <table>
                                      <tr>
                                          <th width='120px'>First Name</th>
                                          <td>{{ $model->user->first_name }}</td>
                                      </tr>
                                      <tr>
                                          <th>Last Name</th>
                                          <td>{{ $model->user->last_name }}</td>
                                      </tr>

                                      @if ($model->user->show_email)
                                          <tr>
                                              <th>Email Address</th>
                                              <td>{{ $model->user->email }}</td>
                                          </tr>
                                      @endif

                                  </table>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Image</div>
                          <div class="panel-body text-center">
                            @if ($model->user->image)
                              {{ Html::image("images/profiles/" . $model->user->image, "",array('height'=>'115','width'=>'115')) }}
                            @else
                              <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                            @endif
                          </div>
                        </div>
                      </div>
                  </div>
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
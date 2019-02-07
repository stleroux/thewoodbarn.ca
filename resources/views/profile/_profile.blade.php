<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">General Information</div>
        <div class="panel-body">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">Personal Info</div>
              <div class="panel-body">
                <table>
                  <tr>
                    <th width='120px'>First Name</th>
                    <td>{{ $user->first_name }}</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>{{ $user->last_name }}</td>
                  </tr>
                  @if ($user->show_email)
                    <tr>
                        <th>Email Address</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                  @endif
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-heading">Image</div>
              <div class="panel-body text-center">
                 @if ($user->image)
                  {{ Html::image("images/profiles/" . $user->image, "",array('height'=>'115','width'=>'115')) }}
                @else
                  <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">User Preferences</div>
                <div class="panel-body">
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Style</div>
                      <div class="panel-body">{{ ucfirst($user->style) }}</div>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Display Email</div>
                      <div class="panel-body">
                        @if ($user->show_email)
                          <i class="fa fa-check" aria-hidden="true"></i>
                        @else
                          <i class="fa fa-ban" aria-hidden="true"></i>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Landing Page</div>
                        <div class="panel-body">
                          {{ $user->landingPage ? ucfirst($user->landingPage) : 'N/A'}}
                        </div>
                      </div>
                    </div>
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Display Size</div>
                      <div class="panel-body">{{ ucfirst($user->display) }}</div>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Author Format</div>
                      <div class="panel-body">
                        @if ($user->authorFormat == 1)
                          Username
                        @endif
                        @if ($user->authorFormat == 2)
                          Last Name, First Name
                        @endif
                        @if ($user->authorFormat == 3)
                          First Name Last Name
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Date Format</div>
                      <div class="panel-body">
                        @if ($user->dateFormat == 1)
                          Jan 01, 2017
                        @endif
                        @if ($user->dateFormat == 2)
                          Jan 1, 2017
                        @endif
                        @if ($user->dateFormat == 3)
                          01/01/2017 (M-D-Y)
                        @endif
                        @if ($user->dateFormat == 4)
                          1/01/2017 (M-D-Y)
                        @endif
                        @if ($user->dateFormat == 5)
                          01 Jan 2017
                        @endif
                        @if ($user->dateFormat == 6)
                          1 Jan 2017
                        @endif
                        @if ($user->dateFormat == 7)
                          01/01/2017 (D-M-Y)
                        @endif
                        @if ($user->dateFormat == 8)
                          1/01/2017 (D-M-Y)
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Rows Per Page</div>
                      <div class="panel-body">{{ $user->rowsPerPage }}</div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Action Buttons</div>
                      <div class="panel-body">
                        @if ($user->actionButtons == 1)
                          Icons and Text
                        @endif
                        @if ($user->actionButtons == 2)
                          Icons Only
                        @endif
                        @if ($user->actionButtons == 3)
                          Text Only
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-heading">Alert Fade Time</div>
                      <div class="panel-body">
                        @if ($user->alertFadeTime == 2000)
                          2 seconds
                        @endif
                        @if ($user->alertFadeTime == 3000)
                          3 seconds
                        @endif
                        @if ($user->alertFadeTime == 4000)
                          4 seconds
                        @endif
                        @if ($user->alertFadeTime == 5000)
                          5 seconds
                        @endif
                        @if ($user->alertFadeTime == 6000)
                          6 seconds
                        @endif
                        @if ($user->alertFadeTime == 7000)
                          7 seconds
                        @endif
                        @if ($user->alertFadeTime == 8000)
                          8 seconds
                        @endif
                        @if ($user->alertFadeTime == 9000)
                          9 seconds
                        @endif
                        @if ($user->alertFadeTime == 10000)
                          10 seconds
                        @endif
                        @if ($user->alertFadeTime == 15000)
                          15 seconds
                        @endif
                        @if ($user->alertFadeTime == 20000)
                          20 seconds
                        @endif
                        @if ($user->alertFadeTime == 1000000000)
                          Forever
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                  See the Edit Profile page for more info on what each settings does
                </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Account Information</div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">Date(s)</div>
                    <div class="panel-body">
                      <table class="" width="100%">
                        <tr>
                          <th width="50%">Created on</th>
                          <td>
                            <span class="pull-right">
                              @include('layouts.common.dateFormat', ['model'=>$user, 'field'=>'created_at'])
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <th>Updated on</th>
                          <td align='right'>@include('layouts.common.dateFormat', ['model'=>$user, 'field'=>'updated_at'])</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">Account Type</div>
                    <div class="panel-body">
                      {{ ucfirst($user->role->name) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

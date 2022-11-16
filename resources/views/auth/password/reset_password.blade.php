@section('reset_password')

                    <form id='passData' action=""method='POST'>
                        @csrf
                        <fieldset class="p-4">
                             <label>New Password</label>
                              <input type="password"name='password' placeholder="Password*" class="border p-3 w-100 my-2">
                                  <small class='text text-danger' id="password_error"></small>
                              <input type="password"name='confirmation_password' placeholder="Confirm Password*" class="border p-3 w-100 my-2">
                                  <small class='text text-danger' id="confirmation_password_error"></small>
                             @if (isset($user) && $user != null)
                              <input type="hidden"name='id' value='{{$user->id}}'>
                             @endif
                            <button id='subData'  type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Change</button>
                              <div id="success"class='text text-danger'></div>
                        </fieldset>
                    </form>

<!--============================ !>

@stop

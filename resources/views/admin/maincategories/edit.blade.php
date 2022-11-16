@extends('layouts.html')
@section('content')
    @include('layouts.section')
    <section class="dashboard section">
        <!-- Container Start -->
        <div class="container">
          <!-- Row Start -->
          <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
              <div class="sidebar">
                <!-- admin Widget -->
                @include('profiles.profile')
                <!-- Dashboard Links -->


                <!-- delete-account modal -->
                                          <!-- delete account popup modal start-->
                      <!-- Modal -->
                      @include('admin.modal')
                      <!-- delete account popup modal end-->
                <!-- delete-account modal -->

              </div>
            </div>

          {{-- forma --}}

          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
            <!-- Recently Favorited -->
            <div class="widget dashboard-container my-adslist">
              @include('alarms.alarm')
                <h3 class="widget-header">Edit  Main Category</h3>
          <form  action="{{route('edit_maincategory',$data_category->id)}}"method='POST'enctype='multipart/form-data'>
            @csrf
                 <input type='hidden' name="id"value='{{$data_category->id}}'>
            {{-- photo --}}
              <label for="exampleFormControlInput1" class="form-label">Image Category</label><br>
              <img width="120px" height="auto" src="{{asset('admin/images/maincategories/'.$data_category->image)}}"><br>
              <br>
          @if(app()->getLocale() == 'ar')

            <label for="exampleFormControlInput1" class="form-label"></label><br>
            <input type="file" name='image' class="form-control"><br>
            @error('image')
              <div class="alert alert-danger" role="alert">
                {{$message}}
              </div>
            @enderror
              @endif
          <input class="form-control form-control-sm" type="text"name='category[0][category]'value="{{$data_category->category}}" placeholder="The Category" aria-label=".form-control-sm example"><br>
          @error('category.0.category')
          <div class="alert alert-danger" role="alert">
            {{$message}}
          </div>
          @enderror
                 <select name="category[0][translation_lang]">
                    @foreach($langs as $lang)
                         <option @if($lang->abbr==$data_category->translation_lang) selected @endif>{{$lang->abbr}}</option>
                      @endforeach

{{--          <input class="form-control form-control-lg"name='category[0][translation_lang]' type="text" placeholder="The Lang" aria-label=".form-control-lg example"> <br>--}}
                 </select>
        @error('category.0.translation_lang')
        <div class="alert alert-danger" role="alert">
          {{$message}}
        </div>
        @enderror
        <br><br>
          <div style='margin-left:20px' class="form-check form-switch">

            <input class="form-check-input" name="category[0][status]"value='1'
             type="checkbox" id="flexSwitchCheckDefault"@if($data_category->status==1) checked @endif >

            <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
          </div>

              @if(locale_lang() == 'ar')
              <input class="form-control form-control-sm" type="text" name='average' value="{{isset($data_category->average)?$data_category->average->average:''}}" placeholder="The Average">
              @error('average')
              <div class="alert alert-danger" role="alert">
                  {{$message}}
              </div>
              <br>
              @enderror
              @else
             <input class="form-control form-control-sm" type="hidden" name='average' value="{{isset($data_category->average)?$data_category->average->average:''}}" >

              @endif



          <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Update</button>
          </form>

            </div>


                  @isset($data_category->translations)

                                  <ul class="nav nav-tabs">
                  @foreach ($data_category->translations as $c=> $trans)
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#home{{$trans->id}}">{{$trans->translation_lang}}</a>
                        </li>
                  @endforeach

                    </ul>
                  <div class="tab-content">
                      @foreach ($data_category->translations as $c=> $trans)

                          <div class="tab-pane container active" id="home{{$trans->id}}">
                              <div class="widget dashboard-container my-adslist">

                                  <h3 class="widget-header">Edit Main Category</h3>

                                  <form class="allData" action="{{route('edit_maincategory',$trans->id)}}"method='POST'enctype='multipart/form-data'>
                                      @csrf
                                      <input type='hidden' name="id"value='{{$trans->id}}'>

                                      <br>
                                      <select name="category[0][translation_lang]">
                                          @foreach($langs as $lang)
                                              <option @if($lang->abbr==$trans->translation_lang) selected @endif>{{$lang->abbr}}</option>
                                          @endforeach
                                      </select> <br><br>
                                      @error('category.0.translation_lang')
                                      <div class="alert alert-danger" role="alert">
                                          {{$message}}
                                      </div>
                                      @enderror
                                      <input class="form-control form-control-sm" type="text"
                                             name='category[0][category]'value="{{$trans->category}}" placeholder="abbr" aria-label=".form-control-sm example">
                                      @error('category.0.category')
                                      <div class="alert alert-danger" role="alert">
                                          {{$message}}
                                      </div>
                                      @enderror

                                      <input class="form-control form-control-sm" type="hidden"
                                      name='average'value="{{isset($trans->average)?$trans->average->average:''}}">

                                      <div class="form-check form-switch">
                                          <input class="form-check-input" name="category[0][status]"value='1'
                                            type="checkbox" id="flexSwitchCheckDefault"@if($trans->status==1) checked @endif >

                                          <label class="form-check-label" for="flexSwitchCheckDefault">Statue</label>
                                      </div>


                                      <button type="submit" class="submitData d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3">Update</button>
                                  </form>
                              </div>
                          </div>
                      @endforeach
                  </div>
             @endisset
          </div>
       </div>
    </div>
 </section>

    <!--================ Footer ===============-->
    @include('layouts.footer')
@endsection



<style>
    #hide_lang{
        display: none;
    }
</style>


@section('scripts')
<script>
  @include('accounts.delete_account');
</script>
@endsection

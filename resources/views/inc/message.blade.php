@if(session()->has('success'))
    <x-alert type="success" :message="session()->get('success')"></x-alert>
@endif

@if(session()->has('error'))
    <x-alert type="danger" :message="session()->get('error')"></x-alert>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <x-alert type="danger" :message="$error"></x-alert>
    @endforeach
@endif

@if($errors->has('name'))
   <div class="alert alert-danger">
       @foreach($errors->get('name') as $error)
          <p style="color: brown"> {{ $error }}</p>
       @endforeach
   </div>
@endif

@if($errors->has('email'))
    <div class="alert alert-danger">
        @foreach($errors->get('email') as $error)
            <p style="color: brown"> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if($errors->has('password'))
    <div class="alert alert-danger">
        @foreach($errors->get('password') as $error)
            <p style="color: brown"> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if($errors->has('newPassword'))
    <div class="alert alert-danger">
        @foreach($errors->get('newPassword') as $error)
            <p style="color: brown"> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if($errors->has('phone'))
    <div class="alert alert-danger">
        @foreach($errors->get('phone') as $error)
            <p style="color: brown"> {{ $error }}</p>
        @endforeach
    </div>
@endif

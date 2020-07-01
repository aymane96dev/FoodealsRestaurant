@extends('layouts.app')

@section('content')
<br/>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 style="color: crimson;">Verification</h2>
                <div class="card-body">
        <div style="color:purple">
              *  Bonjour {{$list}}, Cette page est spécifié pour votre confirmation, saisissez un nouveau mot de passe et confirmer le!
                 <div class="tbl-header">
                    <form method="POST" action="{{url('/confirm') }}" class="was-validated">
                        @csrf

                        {{-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="number" step=0.0000000001 required=""  class="form-control{{ $errors->has('Latitude') ? ' is-invalid' : '' }} @if($errors->get('Latitude')) is-invalid @endif"  name="Latitude" value="{{ old('Latitude') }}"  autofocus>
                                @if ($errors->has('Latitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="password" required="" type="number" step=0.0000000001 step=20 class="form-control is-valid{{ $errors->has('Longitude') ? ' is-invalid' : '' }} @if($errors->get('Longitude')) is-invalid @endif" value="{{old('Longitude')}}" name="Longitude" >
                                @if ($errors->has('Longitude'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Longitude') }}</strong>
                                    </span>
                                @endif
                                       </div>
                        </div> --}}
                        <table>
                    <tr>
                        <td>
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        </td>
                        <td>
                                <input id="email" type="password"  required=""  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} @if($errors->get('password')) is-invalid @endif"  name="password" value="{{ old('email') }}"  autofocus>
                                @if ($errors->has('password'))
                                    <span style="display: contents;" >
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                            <tr>
                                <td>     
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation') }}</label>
</td> 
<td>
                                <input id="password" required="" type="password" class="form-control is-valid{{ $errors->has('Confirmation') ? ' is-invalid' : '' }} @if($errors->get('Confirmation')) is-invalid @endif" name="Confirmation" >
                                @if ($errors->has('Confirmation'))
                                    <span style="display: contents;">
                                        {{ $errors->first('Confirmation') }}
                                    </span>
                                @endif
                                       
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">   
                             <button type="submit" id="myBtn" >{{ __('Enregistrer') }} </button>
</td>
                            </tr>
                            </table>   
                    </form>
                </div>

            </div>
        </div>
    </div>

        </div>
    </div>
            </div>

</div>
@endsection
    
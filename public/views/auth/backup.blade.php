// Backup of register File.
<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-md-4 col-form-label text-md-end">Clinic's Name</label>
    <div class="col-md-6">
        <select  class="form-select" id="" name="clinic">
          <option value=""></option>
          <option value="1">MAM Office</option>
          <option value="71">HTY-A</option>
          <option value="72">HTY-B</option>
          <option value="73">SPT</option>
          <option value="75">Winka</option>
          <option value="76">TBZY</option>
          <option value="77">PTO-DT</option>
          <option value="78">PTO-MCB</option>
          <option value="80">Hpakant</option>
          <option value="81">HTY-C2</option>
          <option value="82">Taze</option>
          <option value="83">HTY-C1</option>
        </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="" class="col-md-4 col-form-label text-md-end">Access Level</label>
    <div class="col-md-6">
        <select  id=""class="form-select" name="type">
          <option value=""></option>
          <option value="1">Receptionists/HE/Peer</option>
          <option value="2">Data Assistant</option>
          <option value="3">MD</option>
          <option value="4">Councellor</option>
          <option value="5">Team Leader</option>
        </select>
    </div>
  </div>

<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</div>

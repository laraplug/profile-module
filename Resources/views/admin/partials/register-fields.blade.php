<hr>

<div class="form-group has-feedback {{ $errors->has('profile.phone') ? ' has-error has-feedback' : '' }}">
    <input type="tel" name="profile[phone]" class="form-control" placeholder="{{ trans('profile::profiles.form.phone') }}" value="{{ old('profile.phone') }}">
    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
    {!! $errors->first('profile.phone', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group has-feedback {{ $errors->has('profile.postcode') ? ' has-error has-feedback' : '' }}">
    <input type="text" name="profile[postcode]" class="form-control" placeholder="{{ trans('profile::profiles.form.postcode') }}" value="{{ old('profile.postcode') }}">
    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
    {!! $errors->first('profile.postcode', '<span class="help-block">:message</span>') !!}
</div>


<div class="form-group has-feedback {{ $errors->has('profile.address') ? ' has-error has-feedback' : '' }}">
    <input type="text" name="profile[address]" class="form-control" placeholder="{{ trans('profile::profiles.form.address') }}" value="{{ old('profile.address') }}">
    <span class="glyphicon glyphicon-road form-control-feedback"></span>
    {!! $errors->first('profile.address', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group has-feedback {{ $errors->has('profile.address_detail') ? ' has-error has-feedback' : '' }}">
    <input type="text" name="profile[address_detail]" class="form-control" placeholder="{{ trans('profile::profiles.form.address_detail') }}" value="{{ old('profile.address_detail') }}">
    <span class="glyphicon glyphicon-home form-control-feedback"></span>
    {!! $errors->first('profile.address_detail', '<span class="help-block">:message</span>') !!}
</div>

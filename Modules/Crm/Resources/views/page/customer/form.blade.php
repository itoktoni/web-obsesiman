<x-area :selector="['area_contact']" />
<x-area :selector="['area_delivery']" />
<x-area :selector="['area_invoice']" />

<div class="form-group">
    {!! Form::label('name', 'Nama Rumah Sakit', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_name') ? 'has-error' : ''}}">
        {!! Form::text('crm_customer_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('crm_customer_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Contact Person', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_contact_person') ? 'has-error' : ''}}">
        {!! Form::text('crm_customer_contact_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('crm_customer_contact_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', 'Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_contact_email') ? 'has-error' : ''}}">
        {!! Form::text('crm_customer_contact_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('crm_customer_contact_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'No. Telp', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_contact_phone') ? 'has-error' : ''}}">
        {!! Form::text('crm_customer_contact_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('crm_customer_contact_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', 'Alamat', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_contact_address') ? 'has-error' : ''}}">
        {!! Form::textarea('crm_customer_contact_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('crm_customer_contact_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('crm_customer_contact_description') ? 'has-error' : ''}}">
        {!! Form::textarea('crm_customer_contact_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('crm_customer_contact_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Contact Area', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('crm_customer_contact_rajaongkir_area_id') ? 'has-error' : ''}}">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary area_contact" type="button">Contact</button>
                <input type="hidden" name="area_contact" value="{{ old('area_contact') ?? '' }}">
            </span>
            {{ Form::select('crm_customer_contact_rajaongkir_area_id', old('area_contact') ? [old('crm_customer_contact_rajaongkir_area_id') => old('area_contact')] : $area_contact, null, ['class'=> 'form-control select', 'id' => 'area_contact']) }}
            {!! $errors->first('crm_customer_contact_rajaongkir_area_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
    <div class="panel-body">
        @isset($model->$key)
        {!! Form::model($model, ['route'=>[$action_code, 'code' => $model->$key],'class'=>'form-horizontal
        ','files'=>true])
        !!}
        @else
        {!! Form::open(['route' => $action_code, 'class' => 'form-horizontal', 'files' => true]) !!}
        @endisset
        <div class="panel panel-default">

            <header class="panel-heading">
                @isset($model->$key)
                <h2 class="panel-title">Ubah Data : {{ $model->$key }}</h2>
                @else
                <h2 class="panel-title">Buat Transaksi Baru</h2>
                @endisset
            </header>

            <div class="panel-body line">
                <div class="">
                   
                    <div class="form-group">
                        {!! Form::label('name', 'Rumah Sakit', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-3 {{ $errors->has('laundry_customer_id') ? 'has-error' : ''}}">
                            {{ Form::select('laundry_customer_id', $customers, null, ['class'=> 'form-control', 'id' => 'promo_id']) }}
                            {!! $errors->first('laundry_customer_id', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', 'Tanggal', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-3 {{ $errors->has('laundry_date') ? 'has-error' : ''}}">
                            {!! Form::text('laundry_date', $model->laundry_date ?? date('Y-m-d'),
                            ['class' =>
                            'form-control date']) !!}
                            {!! $errors->first('laundry_date', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::label('name', 'Status', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-3 {{ $errors->has('laundry_status') ? 'has-error' : ''}}">
                            {{ Form::select('laundry_status', $status, null, ['class'=> 'form-control', 'id' => 'promo_id']) }}
                            {!! $errors->first('laundry_status', '<p class="help-block">:message</p>') !!}
                        </div>


                    </div>

                </div>
            </div>
            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right" style="padding:5px">
                    <a id="linkMenu" href="{!! route($module.'_data') !!}" class="btn btn-warning">Kembali</a>
                    @if($action_function == 'update')
                    <a target="__blank" href="{!! route($module.'_print_order', ['code'=> $model->{$key}]) !!}"
                        class="btn btn-danger">Cetak A5</a>
                    <a target="__blank" href="{!! route($module.'_print_order', ['code'=> $model->{$key}, 'type' => 'F4']) !!}"
                        class="btn btn-info">Cetak F4</a>
                    <a target="__blank" href="{!! route($module.'_print_order', ['code'=> $model->{$key}, 'type' => 'A4']) !!}"
                        class="btn btn-success">Cetak A4</a>
                    @endif
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>

        </div>
        @include($folder.'::page.'.$template.'.detail')
        {!! Form::close() !!}

    </div>
</div>

@include($folder.'::page.'.$template.'.script')

@endsection
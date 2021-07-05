<div id="detail" class="panel-body">
    <div class="panel panel-default">
        <div class="row">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <h2 class="panel-title text-right">
                    
                </h2>
            </div>
        </div>
        <div class="panel-body line">
            <div class="">
                <div class="form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
                    <label class="col-md-1 control-label" for="inputDefault">Linen</label>
                    <div class="col-md-3 {{ $errors->has('product') ? 'has-error' : ''}}">
                        {{ Form::select('', $product, null, ['class'=> 'form-control', 'id' => 'product']) }}
                    </div>

                    <label class="col-md-1 control-label" for="inputDefault">Kotor</label>
                    <div class="col-md-1">
                        {!! Form::text('', null, ['id' => 'qty', 'class' => 'number form-control']) !!}
                    </div>

                    <label class="col-md-1 control-label" for="inputDefault">Bersih</label>
                    <div class="col-md-1">
                        {!! Form::text('', null, ['id' => 'price', 'class' => 'money form-control']) !!}
                    </div>

                    <label class="col-md-1 control-label" for="inputDefault">Keterangan</label>
                    <div class="col-md-2 {{ $errors->has('product') ? 'has-error' : ''}}">
                        {{ Form::select('', $tag, null, ['class'=> 'form-control', 'id' => 'notes']) }}
                    </div>

                    <span id="add" style="margin:0px" class="btn btn-primary detail">Tambah</span>

                </div>

            </div>
        </div>

    </div>
</div>

@include($folder.'::page.'.$template.'.table')
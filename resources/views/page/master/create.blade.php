@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
    <div class="panel-body">
    {!! Form::open(['route' => $action_code, 'class' => 'form-horizontal', 'files' => true]) !!}
    <div class="panel panel-default">
        <header class="panel-heading">
          <h2 class="panel-title">@lang('pages.create') Baru</h2>
        </header>

        <div class="panel-body line">
            <div class="">
                @includeIf(Helper::include($template))
            </div>
        </div>
        
        @include($template_action)
    </div>
    {!! Form::close() !!}
</div>
</div>

@endsection
@extends('Backend.template')

@section('h1', $h1)

@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <section class="content">
        <form role="form" name="main_form" action="" data-valid="false" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            @include('Backend.Widgets.control_create', $control_create)

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Основные данные</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label>Обработано</label>
                                <div class="">
                                    <input name="status" type="checkbox" value="1" class="switcherBoolean" {{{ isset($obj) && $obj->status == 1 ? "checked" : "" }}}/>
                                </div>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Имя</dt>
                                <dd>{{ isset($obj) ? $obj->name : "" }}</dd>

                                <dt>E-mail</dt>
                                <dd><a href="mailto:{{ isset($obj) ? $obj->email : "" }}">{{ isset($obj) ? $obj->email : "" }}</a></dd>
                                
                                <dt>Дата написания</td>
                                <dd>{{ isset($obj) ? $obj->created_at : "" }}</dd>

                                <dt>Сообщение</dt>
                                <dd>{{ isset($obj) ? $obj->message : "" }}</dd>
                             </dl>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </form>
    </section>
@endsection
@extends('Backend.template')

@section('h1', $h1)

@section('breadcrumbs', Breadcrumbs::render())

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                @include('Backend.Widgets.control', $control)

                <div class="box">
                    <div class="box-body">
                        <div class="nestable" data-table="sliders" data-max-depth="1">
                            <ol class="dd-list">
                                @forelse ($result as $item)
                                    @include('Backend.Slider.index_item', ['item' => $item, 'result' => $result])
                                @empty
                                <div class="alert alert-warning alert-dismissable">
                                    <h4><i class="icon fa fa-warning"></i>Слайды отсутствуют!</h4>
                                    Предлагаем <a href="{{ url('backend/'.$controller.'/create') }}">добавить новый</a>
                                  </div>
                                @endforelse
                            </ol>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
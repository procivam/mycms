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
                        <div class="nestable" data-table="pages">
                            <ol class="dd-list">
                                @foreach ($result[0] as $item)
                                    @include('Backend.Pages.index_item', ['item' => $item, 'result' => $result])
                                @endforeach
                            </ol>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
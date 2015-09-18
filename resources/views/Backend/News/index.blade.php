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
                        <table id="datatables" data-table="news" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Дата публикации</th>
                                    <th>Алиас</th>
                                    <th>Статус</th>
                                    <th>Заголовок (Title)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->id }}</a></td>
                                    <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->name }}</a></td>
                                    <td>{{ $item->published_at }}</td>
                                    <td>{{ $item->alias }}</td>
                                    <td>
                                        <input type="checkbox" class="listStatus" {{ $item->status ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Дата публикации</th>
                                    <th>Название</th>
                                    <th>Алиас</th>
                                    <th>Статус</th>
                                    <th>Заголовок (Title)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
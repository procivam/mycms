<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        {!! $controls !!}
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ $moduleName }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="datatables" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Alias</th>
                <th>Status</th>
                <th>Title</th>
              </tr>
            </thead>
            <tbody>
              @foreach($result as $item)
              <tr>
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->id }}</a></td>
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->name }}</a></td>
                <td>{{ $item->alias }}</td>
                <td>
                  <div class="btn-group">
                    @if($item->status == 0)
                      <button type="button" class="btn btn-xs btn-danger">Невидимы</button>
                      <button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Открыть список</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <button type="button" class="btn btn-xs btn-success">Отобразить</button>
                        </li>
                      </ul>
                    @elseif($item->status == 1)
                      <button type="button" class="btn btn-xs btn-success">Видимый</button>
                      <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Открыть список</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <button type="button" class="btn btn-xs btn-danger">Скрыть</button>
                        </li>
                      </ul>
                    @endif
                  </div>
                </td>
                <td>{{ $item->title }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Alias</th>
                <th>Status</th>
                <th>Title</th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
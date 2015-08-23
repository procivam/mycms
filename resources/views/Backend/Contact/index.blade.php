<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        {!! $controls !!}
      <div class="box">
        <div class="box-body">
          <table id="datatables" data-order="no-order" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Содержание</th>
                <th>Дата создания</th>
                <th>Статус</th>
              </tr>
            </thead>
            <tbody>
              @foreach($result as $item)
              <tr>
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->id }}</a></td>
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->name }}</a></td>
                <td><a href="mailto:{{ $item->email }}" target="_blank">{{ $item->email }}</a></td>
                <td>{{ str_limit($item->message, 150, '...') }}</td>
                <td>{{ $item->created_at }}</td>
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
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Содержание</th>
                <th>Дата создания</th>
                <th>Статус</th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
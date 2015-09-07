<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        {!! $controls !!}
      <div class="box">
        <div class="box-body">
          <table id="datatables" data-table="contacts" class="table table-bordered table-striped">
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
              <tr data-id="{{ $item->id }}">
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить" title="Изменить">{{ $item->id }}</a></td>
                <td><a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить" title="Изменить">{{ $item->name }}</a></td>
                <td><a href="mailto:{{ $item->email }}" target="_blank" alt="Отправить сообщение" title="Отправить сообщение">{{ $item->email }}</a></td>
                <td>{{ str_limit($item->message, 150, '...') }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                  <input type="checkbox" class="listStatus" {{ $item->status ? 'checked' : '' }}>
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
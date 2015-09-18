 <!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    @if ($count > 0)
      <span class="label label-success">{{ $count }}</span>
    @endif
  </a>
  <ul class="dropdown-menu">
    <li class="header">{{ Lang::choice('backend.New messages', $count,  ['count' => $count]) }}</li>
      @if ($count > 0)
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            @foreach ($listMessages as $message)
              <li><!-- start message -->
                <a href="{{ url('backend/contact/show/' . $message->id) }}">
                  <div class="pull-left">
                    <img src="/Backend/img/user2-160x160.jpg" class="img-circle" alt="{{ $message->name }}"/>
                  </div>
                  <h4>
                    {{ $message->name }}
                    <small title="{{ $message->created_at }}"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</small>
                  </h4>
                  <p>{{ $message->message }}</p>
                </a>
              </li><!-- end message -->
            @endforeach
          </ul>
        </li>
      @endif
      <li class="footer"><a href="{{ url('backend/contact') }}">{{ trans('backend.See All Messages') }}</a></li>
    </ul>
</li>
<ul class="treeview-menu">
  @foreach($menu[$parent_id] as $item)
    <?php $active = $_SERVER['REQUEST_URI'] == '/backend/'.$item->alias ? 'active' : '' ?>
  	<li class="{{ $active }}">
  		@if(!isset($menu[$item->id]) AND isset($item->add_button))
      		<a href="{{ url('/backend/' . $item->add_link) }}" class="pull-right btn add-but btn-xs {{ $item->add_class or 'btn-success' }}">{{ $item->add_button }}</a>
      	@endif
  		<a href="{{ url('/backend/' . $item->alias) }}">
  			<i class="fa {{ $item->icon or 'fa-circle-o' }}"></i> {{ $item->name }}
  			@if(isset($menu[$item->id]))
	  		  <i class="fa fa-angle-left pull-right"></i>
  			@endif
  		</a>
  		@if(isset($menu[$item->id]))
          {!! view('Backend.Widgets.menu_childs', ['menu' => $menu, 'parent_id' => $item->id]) !!}
        @endif
	</li>
  @endforeach
</ul>
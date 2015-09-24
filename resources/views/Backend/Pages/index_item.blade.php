<li class="dd-item" data-id="{{ $item->id }}">
    <div class="dd-handle">
    	<i class="fa fa-bars"></i>
	</div>
    <div class="dd-content">
    	<table>
    		<tr>
    			<td width="100%">
    				<a href="{{ url('backend/'.$controller.'/edit/'.$item->id) }}" alt="Изменить">{{ $item->name }}</a>
    			</td>
    			<td class="checkStatus">
    				<input type="checkbox" class="listStatus" {{ $item->status ? 'checked' : '' }}>
    			</td>
    			<td class="controlDropdown">
    				<a href="{{ url('backend/'.$controller.'/destroy/'.$item->id) }}" class="smkConfirm">удалить</a>
    			</td>
    		</tr>
    	</table>
    </div>
    @if(array_key_exists($item->id, $result))
	    <ol class="dd-list">
	    	@foreach($result[$item->id] as $item)
	        	@include('Backend.Pages.index_item', ['item' => $item, 'result' => $result])
	        @endforeach
	    </ol>
    @endif
</li>
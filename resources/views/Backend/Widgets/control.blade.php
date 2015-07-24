<div class="box box-primary">
	<div class="box-body">
	    @if(isset($create))
			<a href="{{ url('backend/'.$controller.'/create') }}" class="btn btn-success" title="Добавить"><i class="fa fa-plus"></i></a>
		@endif
		
		@if(isset($createLong))
			<a href="{{ url('backend/'.$controller.'/create') }}" class="btn btn-success" title="Добавить"><i class="fa fa-plus"></i>Добавить</a>
		@endif
		
	    @if(isset($edit))
			<a href="{{ url('backend/'.$controller.'/edit') }}" class="btn btn-info" title="Редактировать"><i class="fa fa-edit"></i></a>
		@endif

		@if(isset($publish))
			<div class="btn-group">
			    <button class="btn btn-warning" title="Опубликовать"><i class="fa fa-eye"></i></button>
			    <button class="btn btn-warning" title="Снять с публикации"><i class="fa fa-eye-slash"></i></button>
			</div>
		@endif

		@if(isset($delete))
			<a href="#" class="btn btn-danger" title="Удалить"><i class="fa fa-remove"></i></a>
		@endif

		@if(isset($date_range))
			<button class="btn btn-default pull-right" id="daterange-btn">
				<i class="fa fa-calendar"></i> Период дат
				<i class="fa fa-caret-down"></i>
			</button>
		@endif
	</div>
</div>
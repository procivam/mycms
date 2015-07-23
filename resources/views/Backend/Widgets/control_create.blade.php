<div class="box">
	<div class="box-body">
		<div class="action_name">
			<h3>{{ $actionName }}</h3>
		</div>
		<div class="buttons">
		    @if($save)
		    	<input type="submit" value="Сохранить" class="btn btn-success">
			@endif
			
		    @if($saveAndExit)
		    	<input type="submit" value="Сохранить и выйти" class="btn bg-orange">
			@endif

			@if($saveAndLook)
		    	<input type="submit" value="Сохранить и просмотреть" class="btn btn-info">
			@endif

			@if($close)		
				<a href="{{ "/backend/$controller" }}" class="btn btn-danger close_form" title="Закрыть">Закрыть</a>
			@endif
		</div>
	</div>
</div>
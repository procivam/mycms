<div class="box">
	<div class="box-body">
		<div class="action_name">
			<h3>{{ $actionName }}</h3>
		</div>
		<div class="buttons">
		    @if(isset($save))
		    	<input type="submit" name="action" value="Сохранить" class="btn btn-success">
			@endif
			
		    @if(isset($saveAndExit))
		    	<input type="submit" name="action" value="Сохранить и выйти" class="btn bg-orange">
			@endif

			@if(isset($saveAndLook))
		    	<input type="submit" name="action" value="Сохранить и просмотреть" class="btn btn-info">
			@endif

			@if(isset($close))		
				<a href="{{ "/backend/$controller" }}" class="btn btn-danger close_form" title="Закрыть">Закрыть</a>
			@endif
		</div>
	</div>
</div>
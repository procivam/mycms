<section class="content">
	<form role="form" name="main_form" action="" method="post" enctype="multipart/form-data">
		{!! csrf_field() !!}
		{!! $controls !!}

		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="row">
			<div class="col-md-7">
				<div class="box box-success">
					<div class="box-header">
						<h3 class="box-title">Основные данные</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
		                    <label>
		                    Видимость на сайте
		                    </label>
		                    <div class="">
		                    	<input name="status" type="checkbox" value="1" class="switcher" {{{ isset($obj) && $obj->status == 1 ? "checked" : "" }}}/>
		                    </div>
		                </div>
		                
		                	<label>Статус</label>
		                <div class="radio">
		                    <label>
		                    	<input type="radio" name="state" value="1" class="flat-green" {{{ ((isset($obj) && $obj->state == 1) OR (isset($obj) == false)) ? "checked" : "" }}}/>
		                    	Опубликован
		                    </label>
		                </div>
		                <div class="radio">
		                    <label>
		                    	<input type="radio" name="state" value="2" class="flat-blue" {{{ isset($obj) && $obj->state == 2 ? "checked" : "" }}}/>
								Черновик
		                    </label>
		                </div>
		                <div class="radio">
		                    <label>
		                    	<input type="radio" name="state" value="0" class="flat-red" {{{ isset($obj) && $obj->state == 0 ? "checked" : "" }}}/>
		                     	Скрыт
		                    </label>
		                </div>

	                    <div class="form-group">
	                      <label>Название</label>
	                      <input type="text" name="name" value="{{ isset($obj) ? $obj->name : "" }}" class="form-control" id="slugify_source" placeholder="Название страницы" minlength="1" maxlength="255" required/>
	                    </div>
	                    <div class="form-group">
	                      <label>Алиас</label>
	                      <input type="text" name="alias" value="{{ isset($obj) ? $obj->alias : "" }}" class="form-control" id="slugify_target" placeholder="Алиас страницы" minlength="1" maxlength="255" required/>
	                    </div>
	                    <div class="form-group">
	                      <label>Содержание</label>
	                      <textarea id="ckeditor" name="text" class="form-control" rows="10" placeholder="Содержание страницы" required>{{ isset($obj) ? $obj->text : "" }}</textarea>
	                    </div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
			<div class="col-md-5">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">SEO информация</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
	                        <label>H1</label>
	                        <input type="text" name="h1" value="{{ isset($obj) ? $obj->h1 : "" }}" class="form-control" placeholder="" minlength="1" maxlength="255" required/>
	                    </div>
						<div class="form-group">
	                        <label>Title (Заголовок)</label>
	                        <input type="text" name="title" value="{{ isset($obj) ? $obj->title : "" }}" class="form-control" placeholder="Заголовок страницы" minlength="1" maxlength="255" required/>
	                    </div>
	                    <div class="form-group">
	                        <label>Keywords (Ключевые слова)</label>
	                        <input type="text" name="keywords" value="{{ isset($obj) ? $obj->keywords : "" }}" class="form-control taginput" placeholder="Ключевые слова для страницы"/>
	                    </div>
						<div class="form-group">
	                        <label>Description (Описание)</label>
		                    <textarea name="description" value="{{ isset($obj) ? $obj->description : "" }}" class="form-control" rows="7" placeholder="Описание страницы"></textarea>
	                    </div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</form>
</section>
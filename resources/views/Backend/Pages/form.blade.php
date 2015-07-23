<section class="content">
	<form role="form" name="main_form" action="" method="post" enctype="multipart/form-data">
		{!! $controls !!}
		<div class="row">
			<div class="col-xs-7">
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
		                    	<input name="status" type="checkbox" class="switcher" {{ isset($obj) && $obj->status == 1 ? "checked" : "" }}/>
		                    </div>
		                </div>
	                    <div class="form-group">
	                      <label>Название</label>
	                      <input type="text" name="name" value="{{ isset($obj) && $obj->name }}" class="form-control" placeholder="Название страницы"/>
	                    </div>
	                    <div class="form-group">
	                      <label>Алиас</label>
	                      <input type="text" name="alias" value="{{ isset($obj) && $obj->alias }}" class="form-control" placeholder="Алиас страницы"/>
	                    </div>
	                    <div class="form-group">
	                      <label>Содержание</label>
	                      <textarea id="ckeditor" name="content" value="{{ isset($obj) && $obj->content }}" class="form-control" rows="10" placeholder="Содержание страницы"></textarea>
	                    </div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
			<div class="col-xs-5">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">SEO информация</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
	                        <label>H1</label>
	                        <input type="text" name="h1" value="{{ isset($obj) && $obj->h1 }}" class="form-control" placeholder=""/>
	                    </div>
						<div class="form-group">
	                        <label>Title (Заголовок)</label>
	                        <input type="text" name="title" value="{{ isset($obj) && $obj->title }}" class="form-control" placeholder="Заголовок страницы"/>
	                    </div>
	                    <div class="form-group">
	                        <label>Keywords (Ключевые слова)</label>
	                        <input type="text" name="keywords" value="{{ isset($obj) && $obj->keywords }}" class="form-control taginput" placeholder="Ключевые слова для страницы"/>
	                    </div>
						<div class="form-group">
	                        <label>Description (Описание)</label>
		                    <textarea name="description" value="{{ isset($obj) && $obj->description }}" class="form-control" rows="7" placeholder="Описание страницы"></textarea>
	                    </div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
	</form>
</section>
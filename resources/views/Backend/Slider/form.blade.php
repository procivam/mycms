@extends('Backend.template')

@section('h1', $h1)

@section('breadcrumbs', Breadcrumbs::render())

@section('content')
	<section class="content">
		<form role="form" name="main_form" action="" method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}

			@include('Backend.Widgets.control_create', $control_create)

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
				<div class="col-md-12">
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
			                
							<div class="form-group">
							    <label for="inuput_file">Изображение</label>
							    @if (isset($obj)  && is_file(media_path().'images/slider/small/'.$obj->image))
						    		<a href="{{ url('backend/'.$controller.'/destroyImage/'.$obj->id) }}" class="btn btn-danger btn-xs">Удалить</a><br>
							    	<div>
							    		<a href="{{ '/Frontend/images/slider/original/'.$obj->image }}" target="blank">
							    			<img src="{{ '/Frontend/images/slider/small/'.$obj->image }}" class="img-thumbnail">
							    		</a>
							    	</div>
							    @else
								    <input type="file" id="inuput_file" name="image">
								    <p class="help-block">Выберите изображение</p>
							    @endif
							</div>
		                    <div class="form-group">
		                      <label>Название</label>
		                      <input type="text" name="name" value="{{ isset($obj) ? $obj->name : "" }}" class="form-control" placeholder="Название" minlength="1" maxlength="255" required/>
		                    </div>
		                    <div class="form-group">
		                      <label>Ссылка</label>
		                      <input type="text" name="url" value="{{ isset($obj) ? $obj->url : "" }}" class="form-control" placeholder="Сыылка на другую страницу" maxlength="255"/>
		                    </div>
		                    
		                    <div class="form-group">
		                      <label>Описание</label>
		                      <textarea id="ckeditor" name="description" class="form-control" rows="10" placeholder="Содержание страницы" required>{{ isset($obj) ? $obj->description : "" }}</textarea>
		                    </div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</form>
	</section>
@endsection
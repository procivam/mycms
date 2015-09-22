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
				<div class="col-md-7">
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">Основные данные</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							@foreach ($result as $obj)
								<div class="form-group">
			                      <label>{{ $obj->name }}</label>
			                      <input type="text" name="DATA[{{ $obj->id }}]" value="{{ $obj->value }}" class="form-control" minlength="1" maxlength="255" required/>
			                    </div>
							@endforeach
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="col-md-5">
					{{-- <div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">SEO информация</h3>
						</div><!-- /.box-header -->
						{{-- <div class="box-body">
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
						</div><!-- /.box-body  -->
					</div><!-- /.box --> --}}
				</div>
			</div>
		</form>
	</section>
@endsection
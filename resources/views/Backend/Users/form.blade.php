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
		                    <div class="form-group">
		                      <label>Имя</label>
		                      <input type="text" name="name" value="{{ isset($obj) ? $obj->name : "" }}" class="form-control" placeholder="Имя" minlength="1" maxlength="255" required/>
		                    </div>
		                    <div class="form-group">
		                      <label>E-mail</label>
		                      <input type="email" name="email" value="{{ isset($obj) ? $obj->email : "" }}" class="form-control" placeholder="E-mail" minlength="1" maxlength="255" required/>
		                    </div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="col-md-5">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Изменение пароля</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							@if (isset($obj))
								<p class="bg-warning">Если нет необходимости изменять пароль - оставьте эти поля пустыми</p>
							@endif
							<div class="form-group">
		                        <label>Новый пароль</label>
		                        <input type="password" name="new_password" class="form-control" placeholder="Новый пароль" {{ !isset($obj) ? 'required' : '' }}/>
		                    </div>
							<div class="form-group">
		                        <label>Повторите новый пароль</label>
		                        <input type="password" name="new_password_confirmation" class="form-control" placeholder="Повторите новый пароль" {{ !isset($obj) ? 'required' : '' }}/>
		                    </div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
		</form>
	</section>
@endsection
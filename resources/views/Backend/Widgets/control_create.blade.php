<div class="box">
    <div class="box-body">
        <div class="action_name">
            <h3>{{ $actionName }}</h3>
        </div>
        <div class="buttons">
            <input type="hidden" name="button_action">
            @if(isset($save))
                <button type="button" name="action" value="save" class="btn btn-success">Сохранить</button>
            @endif
            
            @if(isset($saveAndExit))
                <button type="button" name="action" value="save and exit" class="btn bg-orange">Сохранить и выйти</button>
            @endif

            @if(isset($saveAndLook))
                <button type="button" name="action" value="save and look" class="btn btn-info">Сохранить и просмотреть</button>
            @endif

            @if(isset($close))      
                <a href="{{ "/backend/$controller" }}" class="btn btn-danger close_form" title="Закрыть">Закрыть</a>
            @endif
        </div>
    </div>
</div>
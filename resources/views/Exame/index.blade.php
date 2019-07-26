@include('global')

@isset($alert)
    <div class="alert alert-{{$alert[0]}} mt-1" role="alert">
        {{$alert[1]}}
      </div>
@endisset

    <div class="grid-4">
        @foreach ($exames as $exame)
            {!!$exame!!}
        @endforeach
        <div class="shadow bg-primary btn-block center-flex input-button">
            <input type="text" name="Exame_name" placeholder="Novo exame">
            <a href="exames/create">
                <i class="fas fa-plus text-white"></i>
            </a>
        </div>
    </div>
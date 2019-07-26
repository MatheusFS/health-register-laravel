@include('global')

<form action="/exames/{{$exame->getKey()}}" method="POST">
    @csrf
    @method('PUT')
    <h3 class="m-0 text-dark text-center"><i class="text-muted">Editando</i> {{$exame->getKey()}}</h3>
    <hr class="my-2">
    <table class="table table-striped table-dark table-hover m-0" id="Exame:{{$exame->getKey()}}">
        <tr>
            <th scope="row">-2</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->minus_two}}"></td>
        </tr>
        <tr>
            <th scope="row">-1</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->minus_one}}"></td>
        </tr>
        <tr>
            <th scope="row">0</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->zero}}"></td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->one}}"></td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->two}}"></td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->three}}"></td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->four}}"></td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>Padrão</td>
            <td><input type="text" class="form-control" placeholder="{{$exame->five}}"></td>
        </tr>
    </table>
    <button class="btn btn-primary btn-block">SALVAR</button>
</form>
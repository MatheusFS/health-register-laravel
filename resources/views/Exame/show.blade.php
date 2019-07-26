@include('global')

<div class="bg-light p-2 border rounded shadow">

    <h3 class="m-0 text-dark text-center">
        <a href="/exames/{{$exame->getKey()}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a>
        <a href="/exames/{{$exame->getKey()}}">{{$exame->getKey()}}</a>
        <form action="/exames/{{$exame->getKey()}}" class="d-inline" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </h3>
    <hr class="my-2">
    <table class="table table-striped table-dark table-hover m-0" id="Exame:{{$exame->getKey()}}">
        <tr>
            <th scope="row">-2</th>
            <td>Padrão</td>
            <td>{{$exame->minus_two}}</td>
        </tr>
        <tr>
            <th scope="row">-1</th>
            <td>Padrão</td>
            <td>{{$exame->minus_one}}</td>
        </tr>
        <tr>
            <th scope="row">0</th>
            <td>Padrão</td>
            <td>{{$exame->zero}}</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>Padrão</td>
            <td>{{$exame->one}}</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Padrão</td>
            <td>{{$exame->two}}</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Padrão</td>
            <td>{{$exame->three}}</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>Padrão</td>
            <td>{{$exame->four}}</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>Padrão</td>
            <td>{{$exame->five}}</td>
        </tr>
    </table>

</div>
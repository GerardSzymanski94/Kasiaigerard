@extends('admin.app')

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('success'))

        <div class="alert alert-success">
            Dodano gościa
        </div>
    @endif

    <div class="x_panel">
        <div class="x_title">
            <h2>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table">
                <thead>
                <tr>
                    <th>Imię i nazwisko</th>
                    <th>Osoba towarzysąca</th>
                    <th>Dzieci</th>
                    <th>Potwierdzony</th>
                    <th>Od kogo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input placeholder="Wyszukaj gościa" id="search" class="form-control">
                    </td>
                    <td>
                        {{-- <a class="btn btn-primary" href="{{ route('admin.player.create') }}">
                             Dodaj zawodnika
                         </a>--}}
                    </td>
                    <td>

                    </td>
                    <td>
                        <select id="confirm_select" class="form-control">
                            <option value="">
                                Wszyscy
                            </option>
                            <option value="nie">
                                Nie
                            </option>
                            <option value="tak">
                                Tak
                            </option>
                        </select>
                    </td>
                    <td>
                        <select id="side_select" class="form-control">
                            <option value="">
                                Wszyscy
                            </option>
                            <option value="kasia">
                                KASIA
                            </option>
                            <option value="gerard">
                                GERARD
                            </option>
                        </select>
                    </td>
                </tr>
                @foreach($guests as $guest)
                    <tr>
                        <td class="player">
                            {{ $guest->name }}
                        </td>
                        <td>
                            {{ $guest->person }}
                        </td>
                        <td>
                            {{ $guest->childrens }}
                        </td>
                        <td class="confirm">
                            @if($guest->confirm == 1) <span class="text-success">TAK</span> @else  <span class="text-danger">NIE</span> @endif
                        </td>
                        <td class="side">
                            @if($guest->side == 1) <span class="text-success">GERARD</span> @else  <span class="text-primary">KASIA</span> @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="{{ route('admin.guest.edit', ['guest'=>$guest->id]) }}" class="btn btn-secondary btn-primary"><i class="fa fa-edit"></i>Edytuj</a>--}}
                                <a href="{{ route('admin.guest.delete', ['guest'=>$guest->id]) }}" class="btn btn-secondary btn-danger"
                                   onclick="return confirm('Na pewno usunąć?');"><i class="fa fa-remove"></i>Usuń</a>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="{{ route('admin.guest.edit', ['guest'=>$guest->id]) }}" class="btn btn-secondary btn-primary"><i class="fa fa-edit"></i>Edytuj</a>--}}
                                @if($guest->confirm == 1)
                                    <a href="{{ route('admin.guest.canceled', ['guest'=>$guest->id]) }}" class="btn btn-secondary btn-danger"
                                       onclick="return confirm('Na pewno zrezygnował?');"><i class="fa fa-edit"></i>Zrezygnował</a>
                                @else
                                    <a href="{{ route('admin.guest.confirm', ['guest'=>$guest->id]) }}" class="btn btn-secondary btn-success"
                                    ><i class="fa fa-edit"></i>Potwierdził</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                <td colspan="5">
                    <form action="{{ route('admin.guest.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Imię i nazwisko</label>
                                    <input type="text" name="name" placeholder="Imię i nazwisko" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Osoba towarzysząca</label>
                                    <select name="person" class="form-control">
                                        <option value="0">
                                            Nie
                                        </option>
                                        <option value="1">
                                            Tak
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="name">Ilość dzieci</label>
                                    <select name="childrens" class="form-control">
                                        <option value="0">
                                            0
                                        </option>
                                        <option value="1">
                                            1
                                        </option>
                                        <option value="2">
                                            2
                                        </option>
                                        <option value="3">
                                            3
                                        </option>
                                        <option value="4">
                                            4
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="side">Od kogo</label>
                                    <select name="side" class="form-control">
                                        <option value="0">
                                            Kasia
                                        </option>
                                        <option value="1">
                                            Gerard
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="submit">- </label>
                                    <input type="submit" value="Dodaj" class="btn btn-primary form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#search').on('keyup', function () {
            showAll();
            searchName();
            searchSide();
            searchConfirm();
        });
        $('#side_select').on('change', function () {
            showAll();
            searchName();
            searchSide();
            searchConfirm();
        });
        $('#confirm_select').on('change', function () {
            showAll();
            searchName();
            searchSide();
            searchConfirm();
        });

        function searchName(){
            let src = $('#search').val().toLowerCase();
            $('.player').each(function () {

                var dInput = $(this).text().toLowerCase();

                if (dInput.indexOf(src) != -1) {
                    //$(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }

        function searchSide(){
            let src = $('#side_select').val().toLowerCase();
            console.log(src);
            $('.side').each(function () {

                var dInput = $(this).text().toLowerCase();

                if (dInput.indexOf(src) != -1) {
                 //   $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }
        function searchConfirm(){
            let src = $('#confirm_select').val().toLowerCase();
            $('.confirm').each(function () {

                var dInput = $(this).text().toLowerCase();

                if (dInput.indexOf(src) != -1) {
                  //  $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }
        function showAll(){
            $('.player').each(function () {
                    $(this).parent().show();
            });
        }
    </script>
@endsection
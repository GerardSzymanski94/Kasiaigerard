@extends('admin.app')

@section('content')

    <div class="row">
        <h2>Edycja gościa</h2>
        <form action="{{ route('admin.guest.update', ['guest'=>$guest->id]) }}" method="post">
            @csrf
            <div class="row">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Imię i nazwisko</label>
                        <input type="text" name="name" placeholder="Imię i nazwisko" class="form-control"
                        value="{{ old('name', $guest->name) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Osoba towarzysząca</label>
                        <select name="person" class="form-control">
                            <option value="0">
                                Nie
                            </option>
                            <option @if($guest->person==1) selected @endif value="1">
                                Tak
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Ilość dzieci</label>
                        <select name="childrens" class="form-control">
                            <option value="0">
                                0
                            </option>
                            <option value="1"  @if($guest->childrens==1) selected @endif>
                                1
                            </option>
                            <option value="2"  @if($guest->childrens==2) selected @endif>
                                2
                            </option>
                            <option value="3"  @if($guest->childrens==3) selected @endif>
                                3
                            </option>
                            <option value="4" @if($guest->childrens==4) selected @endif>
                                4
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="side">Od kogo</label>
                        <select name="side" class="form-control">
                            <option value="0">
                                Kasia
                            </option>
                            <option value="1"  @if($guest->side==1) selected @endif>
                                Gerard
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="submit"> </label>
                        <input type="submit" value="Dodaj" class="btn btn-primary form-control">
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')

@endsection
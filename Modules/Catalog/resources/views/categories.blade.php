@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Поставщики</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="custom-file-upload" data-bs-toggle="modal" data-bs-target="#addSeller">
                Создать
            </button>

            <!-- Modal -->
            <form action="{{route('addSeller')}}" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="addSeller" tabindex="-1" aria-labelledby="addSeller" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addSeller">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <label>
                                        <input type="text" id="name" name="name" placeholder="Название поставщика"/>
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Поставщик</th>
                <th scope="col">Дата создания</th>
            </tr>
            </thead>
            @foreach($sellers as $key=>$seller)
                <tbody>
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$seller['name']}}</td>
                    <td>{{date('d-m-Y H:i', strtotime($seller['updated_at']))}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>


    <script>

    </script>
@endsection


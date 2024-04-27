@extends('Layouts.layout')

@section('content')
    <section>
        <div class="row">
            <div class="col align-self-center display-flex">
                <div class="container mx-3">
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <img src="" alt="">
                    </form>
                </div>
            </div>
            <div class="col d-none d-sm-block">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </form>
            </div>    
        </div>
    </section>
@endsection
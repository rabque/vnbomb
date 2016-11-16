@extends("layouts.master")
@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row text-center">
                <h1 class="light-weight">{{ $detail->name }}</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {!! $detail->content  !!}
                </div>
            </div>

        </div>
    </section>



@endsection
@extends("layouts.master")
@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row text-center">
                <h1 class="light-weight">Affiliate Program</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>Receive 10% of profits on all the players you send through your affiliate link. To start making money, type the address to which you wish to receive payments and generate your unique affiliate link.</p>

                    <p>Payments happen every Sunday morning at 06:00 UTC.</p>
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Payment address">
                        </div>
                        <div class="form-group">
                        <button type="submit" style="margin-bottom: 0px" class="btn btn-primary">Get Url</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>



@endsection
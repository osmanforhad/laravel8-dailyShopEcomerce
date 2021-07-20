@extends('admin/layout')

@section('content')


    <h1 class="mb10">Create Category</h1>

    <a href="{{ route('admin.category') }}">
        <button type="button" class="btn btn-success">All Category</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Credit Card</div>
                <div class="card-body">
                    <hr>
                    <form action="" method="post" novalidate="novalidate">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                            <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                        </div>
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">Name on card</label>
                            <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Pay $100.00</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
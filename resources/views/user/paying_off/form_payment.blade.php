@section('elect_payment')
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData['id']}}"></script>

<form action="{{route('make_order_electronic')}}" class="paymentWidgets" data-brands="VISA MASTER AMEX">
</form>
@stop

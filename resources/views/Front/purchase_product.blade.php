@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


@section('content')
<script async src="https://js.stripe.com/v3/pricing-table.js"></script>
<stripe-pricing-table pricing-table-id="prctbl_1PGFWrF36dkxk0XmcNPZ041C"
publishable-key="pk_test_51MY6QMF36dkxk0XmJOpfxK2AZcLfcx8xI7CEMSEF1nNPIVKsJ6JYKly02iqxP3ppxfNvt28ORlwM4Wi78TroccFj00OsTpzuw6">
</stripe-pricing-table>
@endsection
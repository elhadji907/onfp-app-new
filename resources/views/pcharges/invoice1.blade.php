@extends('layout.default')
@section('title', 'ONFP - Fiche demande prise en charge')
@section('content')

    <section class="back">
        @foreach ($pcharges as $pcharge)
            <div class="container">
                <div class="row">
					<div class="d-flex col-lg-12 margin-tb justify-content-between align-items-center">
						<a class="btn btn-outline-success" href="{{ route('pcharges.index') }}"> <i
								class="fas fa-undo-alt"></i>&nbsp;Arrière</a>
								<a class="btn btn-outline-success" title="télécharger" href="{{ url('telecharger', ['$pcharges' => $pcharge->id]) }}" target="_blank"><i class="fas fa-download"></i></a>
					</div>
                    <div class="col-xs-12">
                        <div class="invoice-wrapper">
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice-top-left">
                                            <h2 class="client-company-name">Google Inc.</h2>
                                            <h6 class="client-address">31 Lake Floyd Circle, <br>Delaware, AC 987869
                                                <br>India
                                            </h6>
                                            <h4>Reference</h4>
                                            <h5>UX Design &amp; Development for <br> Android App.</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice-top-right">
                                            <h2 class="our-company-name">Acme LLP</h2>
                                            <h6 class="our-address">477 Blackwell Street, <br>Dry Creek, Alaska <br>India
                                            </h6>
                                            <div class="logo-wrapper">
                                                <img src="{{ asset('images/Acme.png') }}" class="img-responsive pull-right logo" />
												{{--  <img style="width:50%; max-width:100px;" src="{{ asset('images/image_onfp.jpg') }}">  --}}
                                            </div>
                                            <h5>06 September 2017</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="title">Invoice</h2>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="col-sm-3 col-md-3">
                                        <div class="invoice-bottom-left">
                                            <h5>Invoice No.</h5>
                                            <h4>BJI 009872</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-1 col-md-8 col-sm-9">
                                        <div class="invoice-bottom-right">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Qty</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Initial research</td>
                                                        <td>₹10,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>UX design</td>
                                                        <td>₹35,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Web app development</td>
                                                        <td>₹50,000</td>
                                                    </tr>
                                                    <tr style="height: 40px;"></tr>
                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th>₹95,000</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <h4 class="terms">Terms</h4>
                                            <ul>
                                                <li>Invoice to be paid in advance.</li>
                                                <li>Make payment in 2,3 business days.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                        <hr class="divider">
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="text-left">acme.com</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="text-center">contact@acme.com</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="text-right">+91 8097678988</h6>
                                    </div>
                                </div>
                                <div class="bottom-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

@endsection

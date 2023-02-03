@extends('admin.layout')
@section('content')




<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('js/additionalnumber.js') }}"></script>

    <style>
        .header {
            position: sticky;
            top: 0;
        }

        .footer {
            position: sticky;
            bottom: 0;
            background-color: aqua;
            color: black;
        }

        /* tbody tr td {
            height: 5px;
           
        } */


        .my-custom-scrollbar {
            position: relative;
            width: 116%;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .scrollit {
            overflow-y: scroll;
            height: 100px;
        }

    </style>

</head>

@php
    $r_from_date = request()->from_date === null ? '' : request()->from_date;
    $r_to_date = request()->to_date === null ? '' : request()->to_date;

    if (old()) {
    $r_from_date = old('from_date');
    $r_to_date = old('to_date');
    }
@endphp

<body class="antialiased">
    <form action="#" method="get">
        @csrf
        <div class="row">
            <div class="col-md-6 input-group input-daterange">
                <div class="input-group-addon mx-2 pt-2">From:</div>
                <!-- <input type="date" name="from_date" class="form-control" autocomplete="off" value="<?php echo date('Y-m-d'); ?>"> -->
                <input type="date" name="from_date" class="form-control" style="width: 10px;"
                    value="{{ $r_from_date }}">

                <div class="input-group-addon mx-2 pt-2">to</div>
                <input type="date" name="to_date" class="form-control" value="{{ $r_to_date }}">
            </div>
            <div class="col-md-2 col-sm-12">
                <button class="btn btn-primary" style="height: 46px;" id="linkid">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    User Registration
                </div>
                <div class="card-body p-0">

                    <div class="scrollit" id="approvedProfile" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedProfile as $AP)
                                    <tr class="tr1">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $AP->D }}</td>
                                        <td class="loop1">{{ $AP->C }}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total1"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Case
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="appliedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Case</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedCase as $AC)
                                    <tr class="tr2">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $AC->D }}</td>
                                        <td class="loop2">{{ $AC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Case
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="approvedCase" style="height:450px;">
                        <table class="table table-sm ">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Case</th>
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedCase as $APC)
                                    <tr class="tr3">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APC->D }}</td>
                                        <td class="loop3">{{ $APC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Reject Case
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Case</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($RejectedCase as $RC)
                                    <tr class="tr4">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $RC->D }}</td>
                                        <td class="loop4">{{ $RC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Apply Person
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Person</th>

                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedPerson as $APS)
                                    <tr class="tr5">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APS->D }}</td>
                                        <td class="loop5">{{ $APS->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total5"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Person</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedPerson as $APP)
                                    <tr class="tr6">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APP->D }}</td>
                                        <td class="loop6">{{ $APP->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total6"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Person By Type
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Visa</th>
                                    <th scope="col">Stay</th>
                                    <th scope="col">Labour Card</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedPersonByType as $APBT)
                                    <tr class="tr7">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBT->D }}</td>
                                        <td class="loop7">{{ $APBT->Visa }}</td>
                                        <td class="loop71">{{ $APBT->Stay }}</td>
                                        <td class="loop72">{{ $APBT->LabourCard }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total7"></td>
                                    <td id="total71"></td>
                                    <td id="total72"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person By Type
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Visa</th>
                                    <th scope="col">Stay</th>
                                    <th scope="col">Labour Card</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedPersonByType as $APBT)
                                    <tr class="tr8">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBT->D }}</td>
                                        <td class="loop8">{{ $APBT->Visa }}</td>
                                        <td class="loop81">{{ $APBT->Stay }}</td>
                                        <td class="loop82">{{ $APBT->LabourCard }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total8"></td>
                                    <td id="total81"></td>
                                    <td id="total82"></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Case By Country
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Case</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedCaseByCountry as $ACC)
                                    <tr class="tr9">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ACC->N }}</td>
                                        <td class="loop9">{{ $ACC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total9"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Case By Country
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Case</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedCaseByCountry as $ACC)
                                    <tr class="tr10">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ACC->N }}</td>
                                        <td class="loop10">{{ $ACC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total10"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Person By Country
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Person</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedPersonByCountry as $APBC)
                                    <tr class="tr11">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBC->N }}</td>
                                        <td class="loop11">{{ $APBC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total11"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person By Country
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Person</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedPersonByCountry as $APPC)
                                    <tr class="tr12">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APPC->N }}</td>
                                        <td class="loop12">{{ $APPC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total12"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Gender
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Male</th>
                                    <th scope="col">Female</th>
                                </tr>

                            </thead>
                            <tbody>

                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedGender as $APG)
                                    <tr class="tr13">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APG->D }}</td>
                                        <td class="loop131">{{ $APG->Male }}</td>
                                        <td class="loop132">{{ $APG->Female }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total131"></td>
                                    <td id="total132"></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Gender
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Male</th>
                                    <th scope="col">Female</th>
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedGender as $APG)
                                    <tr class="tr14">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APG->D }}</td>
                                        <td class="loop141">{{ $APG->Male }}</td>
                                        <td class="loop142">{{ $APG->Female }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total141"></td>
                                    <td id="total142"></td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Case By Sector
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">

                                <tr>
                                    <th>#</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Case</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedCaseBySector as $ACBC)
                                    <tr class="tr15">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ACBC->N }}</td>
                                        <td class="loop15">{{ $ACBC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total15"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Case By Sector
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Case</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedCaseBySector as $APBC)
                                    <tr class="tr16">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBC->N }}</td>
                                        <td class="loop16">{{ $APBC->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total16"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">

        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Person By Sector
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Person</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($AppliedPersonBySector as $APBS)
                                    <tr class="tr17">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBS->N }}</td>
                                        <td class="loop17">{{ $APBS->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total17"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person By Sector
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Person</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($ApprovedPersonBySector as $APBS)
                                    <tr class="tr18">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APBS->N }}</td>
                                        <td class="loop18">{{ $APBS->C }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total18"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Applied Person By Applicant Type
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Director</th>
                                    <th>Technician/SkilledLabour</th>
                                    <th>Dependant</th>

                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp

                                @foreach( $AppliedPersonByApplicantType as $AT)
                                    <tr class="tr19">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $AT->D }}</td>
                                        <td class="loop19">{{ $AT->Director }}</td>
                                        <td class="loop192">{{ $AT->TechnicianSkilledLabour }}</td>
                                        <td class="loop193">{{ $AT->Dependant }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total19"></td>
                                    <td id="total192"></td>
                                    <td id="total193"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Person By Applicant Type
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Director</th>
                                    <th>Technician/SkilledLabour</th>
                                    <th>Dependant</th>

                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp

                                @foreach( $ApprovedPersonByApplicantType as $APT)
                                    <tr class="tr20">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $APT->D }}</td>
                                        <td class="loop20">{{ $APT->Director }}</td>
                                        <td class="loop202">{{ $APT->TechnicianSkilledLabour }}</td>
                                        <td class="loop203">{{ $APT->Dependant }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total20"></td>
                                    <td id="total202"></td>
                                    <td id="total203"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <!-- ------------------------------------------------------------------------------------------------------------- -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card justify-content-center" style="border: 1px solid lightgray;overflow: hidden;">
                <div class="card-header" style="background-color: #BBDEFB;">
                    Approved Summary
                </div>
                <div class="card-body p-0">
                    <div class="scrollit" id="rejectedCase" style="height:450px;">
                        <table class="table table-sm">
                            <thead style="position: sticky;top: 0; background-color:aqua;">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>DICA</th>
                                    <th>Immigration</th>
                                    <th>Labour</th>
                                </tr>


                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp

                                @foreach( $Approved as $AVD)
                                    <tr class="tr21">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $AVD->d }}</td>
                                        <td class="loop21">{{ $AVD->DICA }}</td>
                                        <td class="loop211">{{ $AVD->Immigration }}</td>
                                        <td class="loop212">{{ $AVD->Labour }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot class="footer">
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td id="total21"></td>
                                    <td id="total211"></td>
                                    <td id="total212"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- ----------------------------------------------------------------------------------------- -->
</body>

</html>
@endsection

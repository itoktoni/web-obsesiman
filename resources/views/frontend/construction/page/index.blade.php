@extends(Helper::setExtendFrontend())

@section('content')

<div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
    <span></span>
    <div class="flex-col-c p-t-50 p-b-50">
        <h3 class="l1-txt1 txt-center p-b-10">
            Coming Soon
        </h3>

        <p class="txt-center l1-txt2 p-b-60">
            Our website is under construction
        </p>

        <div class="flex-w flex-c cd100 p-b-82">
            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 days">35</span>
                <span class="s1-txt1">Days</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 hours">17</span>
                <span class="s1-txt1">Hours</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 minutes">50</span>
                <span class="s1-txt1">Minutes</span>
            </div>

            <div class="flex-col-c-m size2 how-countdown">
                <span class="l1-txt3 p-b-9 seconds">39</span>
                <span class="s1-txt1">Seconds</span>
            </div>
        </div>

        <button class="flex-c-m s1-txt2 size3 how-btn" data-toggle="modal" data-target="#subscribe">
            <img src="{{ Helper::frontend('images/logo.png') }}" alt="">
        </button>
    </div>

    <span class="s1-txt3 txt-center">
        @ 2020 Coming Soon Template. Designed by Obsesiman Team
    </span>

</div>

@endsection